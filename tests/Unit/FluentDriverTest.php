<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit;

use Doctrine\Common\EventManager;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use PHPUnit\Framework\TestCase;
use yjiotpukc\MongoODMFluent\FluentDriver;
use yjiotpukc\MongoODMFluent\MappingException;
use yjiotpukc\MongoODMFluent\MappingFinder\ListMappingFinder;
use yjiotpukc\MongoODMFluent\Tests\Stubs\EntityStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\MappingFinderStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\EntityStubMapping;
use yjiotpukc\MongoODMFluent\Tests\Stubs\TransientChildEntityStub;

class FluentDriverTest extends TestCase
{
    public function testMappingWithMapMethodIsNotTransient(): void
    {
        $mappings = [EntityStub::class => EntityStubMapping::class];
        $driver = new FluentDriver(new ListMappingFinder($mappings));
        self::assertFalse($driver->isTransient(EntityStub::class));
    }

    public function testEntityWithoutMappingIsTransient(): void
    {
        $mappings = [EntityStub::class => EntityStubMapping::class];
        $driver = new FluentDriver(new ListMappingFinder($mappings));
        self::assertTrue($driver->isTransient(TransientChildEntityStub::class));
    }

    public function testReturnsAllEntities(): void
    {
        $mappings = [
            'Entity' => 'Mapping',
            'DifferentEntity' => 'DifferentMapping',
        ];
        $driver = new FluentDriver(new MappingFinderStub($mappings));
        self::assertEquals(['Entity', 'DifferentEntity'], $driver->getAllClassNames());
    }

    public function testReturnsEmptyArrayIfNoEntitiesFound(): void
    {
        $driver = new FluentDriver(new MappingFinderStub([]));
        self::assertEquals([], $driver->getAllClassNames());
    }

    public function testLoadsMapping(): void
    {
        EntityStubMapping::reset();
        $entity = EntityStub::class;
        $mappings = [$entity => EntityStubMapping::class];
        $driver = new FluentDriver(new MappingFinderStub($mappings));
        $driver->setEventManager(new EventManager());
        $driver->loadMetadataForClass($entity, new ClassMetadata($entity));
        self::assertTrue(EntityStubMapping::wasLoaded());
    }

    public function testThrowsExceptionIfMappingDoesNotExist(): void
    {
        $this->expectException(MappingException::class);
        $this->expectExceptionMessage('[Mapping] does not exist');
        $entity = EntityStub::class;
        $mappings = [$entity => 'Mapping'];
        $driver = new FluentDriver(new MappingFinderStub($mappings));
        $driver->loadMetadataForClass($entity, new ClassMetadata($entity));
    }

    public function testThrowsExceptionIfNotMapping(): void
    {
        $this->expectException(MappingException::class);
        $this->expectExceptionMessage('[yjiotpukc\MongoODMFluent\Tests\Stubs\EntityStub] is not a mapping');
        $entity = EntityStub::class;
        $mappings = [$entity => $entity];
        $driver = new FluentDriver(new MappingFinderStub($mappings));
        $driver->setEventManager(new EventManager());
        $driver->loadMetadataForClass($entity, new ClassMetadata($entity));
    }
}
