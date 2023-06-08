<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit;

use Doctrine\Common\EventManager;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use PHPUnit\Framework\TestCase;
use yjiotpukc\MongoODMFluent\FluentDriver;
use yjiotpukc\MongoODMFluent\Loader\AnnotationCompatibleLoader;
use yjiotpukc\MongoODMFluent\Loader\ClassMetadataLoader;
use yjiotpukc\MongoODMFluent\MappingException;
use yjiotpukc\MongoODMFluent\Tests\Stubs\EntityStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\MappingFinderStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\EntityStubMapping;
use yjiotpukc\MongoODMFluent\Tests\Stubs\TransientChildEntityStub;

class FluentDriverTest extends TestCase
{
    public function testMappingWithMapMethodIsNotTransient(): void
    {
        $finder = new MappingFinderStub([EntityStub::class => EntityStubMapping::class]);
        $loader = $this->createMock(ClassMetadataLoader::class);
        $driver = new FluentDriver($finder, $loader);
        self::assertFalse($driver->isTransient(EntityStub::class));
    }

    public function testEntityWithoutMappingIsTransient(): void
    {
        $finder = new MappingFinderStub([EntityStub::class => EntityStubMapping::class]);
        $loader = $this->createMock(ClassMetadataLoader::class);
        $driver = new FluentDriver($finder, $loader);
        self::assertTrue($driver->isTransient(TransientChildEntityStub::class));
    }

    public function testReturnsAllEntities(): void
    {
        $mappings = [
            'Entity' => 'Mapping',
            'DifferentEntity' => 'DifferentMapping',
        ];
        $finder = new MappingFinderStub($mappings);
        $loader = $this->createMock(ClassMetadataLoader::class);
        $driver = new FluentDriver($finder, $loader);
        self::assertEquals(['Entity', 'DifferentEntity'], $driver->getAllClassNames());
    }

    public function testReturnsEmptyArrayIfNoEntitiesFound(): void
    {
        $finder = new MappingFinderStub([]);
        $loader = $this->createMock(ClassMetadataLoader::class);
        $driver = new FluentDriver($finder, $loader);
        self::assertEquals([], $driver->getAllClassNames());
    }

    public function testLoadsMapping(): void
    {
        EntityStubMapping::reset();
        $entity = EntityStub::class;
        $eventManager = $this->createMock(EventManager::class);
        $finder = new MappingFinderStub([$entity => EntityStubMapping::class]);
        $loader = new AnnotationCompatibleLoader($eventManager, $finder->makeMappingSet());
        $driver = new FluentDriver($finder, $loader);
        $driver->setEventManager(new EventManager());
        $driver->loadMetadataForClass($entity, new ClassMetadata($entity));
        self::assertTrue(EntityStubMapping::wasLoaded());
    }

    public function testThrowsExceptionIfMappingDoesNotExist(): void
    {
        $this->expectException(MappingException::class);
        $this->expectExceptionMessage('[Mapping] does not exist');
        $entity = EntityStub::class;
        $finder = new MappingFinderStub([$entity => 'Mapping']);
        $loader = $this->createMock(ClassMetadataLoader::class);
        $driver = new FluentDriver($finder, $loader);
        $driver->loadMetadataForClass($entity, new ClassMetadata($entity));
    }

    public function testThrowsExceptionIfNotMapping(): void
    {
        $this->expectException(MappingException::class);
        $this->expectExceptionMessage('[yjiotpukc\MongoODMFluent\Tests\Stubs\EntityStub] is not a mapping');
        $entity = EntityStub::class;
        $finder = new MappingFinderStub([$entity => $entity]);
        $loader = $this->createMock(ClassMetadataLoader::class);
        $driver = new FluentDriver($finder, $loader);
        $driver->setEventManager(new EventManager());
        $driver->loadMetadataForClass($entity, new ClassMetadata($entity));
    }
}
