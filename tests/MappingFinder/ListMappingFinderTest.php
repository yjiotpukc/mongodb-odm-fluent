<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\MappingFinder;

use PHPUnit\Framework\TestCase;
use yjiotpukc\MongoODMFluent\MappingException;
use yjiotpukc\MongoODMFluent\MappingFinder\ListMappingFinder;
use yjiotpukc\MongoODMFluent\Tests\Stubs\EntityStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\EntityWithoutMappingStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\MappingStub;

class ListMappingFinderTest extends TestCase
{
    public function testFailsIfClassIsNotMapping()
    {
        $className = EntityStub::class;
        $this->expectException(MappingException::class);
        $this->expectExceptionMessage("Class [{$className}] is not a mapping");
        new ListMappingFinder([$className]);
    }

    public function testMappingExists()
    {
        $finder = new ListMappingFinder([MappingStub::class]);
        self::assertTrue($finder->exists(EntityStub::class));
    }

    public function testMappingDoesNotExist()
    {
        $finder = new ListMappingFinder([MappingStub::class]);
        self::assertFalse($finder->exists(EntityWithoutMappingStub::class));
    }

    public function testReturnsMapping()
    {
        $finder = new ListMappingFinder([MappingStub::class]);
        self::assertEquals(MappingStub::class, $finder->find(EntityStub::class));
    }

    public function testFailsIfNoMappingFound()
    {
        $entityClassName = EntityWithoutMappingStub::class;
        $this->expectException(MappingException::class);
        $this->expectExceptionMessage("Mapping for entity [$entityClassName] not found");
        $finder = new ListMappingFinder([MappingStub::class]);
        $finder->find($entityClassName);
    }

    public function testReturnsAllMappings()
    {
        $finder = new ListMappingFinder([MappingStub::class]);
        self::assertEquals([EntityStub::class], $finder->getAll());
    }
}
