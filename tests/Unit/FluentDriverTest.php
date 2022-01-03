<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use PHPUnit\Framework\TestCase;
use yjiotpukc\MongoODMFluent\FluentDriver;
use yjiotpukc\MongoODMFluent\MappingException;
use yjiotpukc\MongoODMFluent\Tests\Stubs\EntityStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\MappingFinderStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\EntityStubMapping;

class FluentDriverTest extends TestCase
{
    public function testReturnsNotTransientIfEntityHasMapping()
    {
        $mappings = ['Entity' => 'Mapping'];
        $driver = new FluentDriver(new MappingFinderStub($mappings));
        self::assertFalse($driver->isTransient('Entity'));
    }

    public function testReturnsTransientIfMappingDoesNotExist()
    {
        $mappings = ['Entity' => 'Mapping'];
        $driver = new FluentDriver(new MappingFinderStub($mappings));
        self::assertTrue($driver->isTransient('DifferentEntity'));
    }

    public function testReturnsAllEntities()
    {
        $mappings = [
            'Entity' => 'Mapping',
            'DifferentEntity' => 'DifferentMapping',
        ];
        $driver = new FluentDriver(new MappingFinderStub($mappings));
        self::assertEquals(['Entity', 'DifferentEntity'], $driver->getAllClassNames());
    }

    public function testReturnsEmptyArrayIfNoEntitiesFound()
    {
        $driver = new FluentDriver(new MappingFinderStub([]));
        self::assertEquals([], $driver->getAllClassNames());
    }

    public function testLoadsMapping()
    {
        EntityStubMapping::reset();
        $entity = EntityStub::class;
        $mappings = [$entity => EntityStubMapping::class];
        $driver = new FluentDriver(new MappingFinderStub($mappings));
        $driver->loadMetadataForClass($entity, new ClassMetadata($entity));
        self::assertTrue(EntityStubMapping::wasLoaded());
    }

    public function testThrowsExceptionIfMappingNotFound()
    {
        $this->expectException(MappingException::class);
        $this->expectExceptionMessage('Mapping for entity [yjiotpukc\MongoODMFluent\Tests\Stubs\EntityStub] not found');
        $entity = EntityStub::class;
        $driver = new FluentDriver(new MappingFinderStub([]));
        $driver->loadMetadataForClass($entity, new ClassMetadata($entity));
    }

    public function testThrowsExceptionIfMappingDoesNotExist()
    {
        $this->expectException(MappingException::class);
        $this->expectExceptionMessage('[Mapping] does not exist');
        $entity = EntityStub::class;
        $mappings = [$entity => 'Mapping'];
        $driver = new FluentDriver(new MappingFinderStub($mappings));
        $driver->loadMetadataForClass($entity, new ClassMetadata($entity));
    }

    public function testThrowsExceptionIfNotMapping()
    {
        $this->expectException(MappingException::class);
        $this->expectExceptionMessage('[yjiotpukc\MongoODMFluent\Tests\Stubs\EntityStub] is not a mapping');
        $entity = EntityStub::class;
        $mappings = [$entity => $entity];
        $driver = new FluentDriver(new MappingFinderStub($mappings));
        $driver->loadMetadataForClass($entity, new ClassMetadata($entity));
    }
}
