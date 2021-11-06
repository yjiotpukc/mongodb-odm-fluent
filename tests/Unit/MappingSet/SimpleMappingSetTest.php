<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\MappingSet;

use PHPUnit\Framework\TestCase;
use yjiotpukc\MongoODMFluent\MappingException;
use yjiotpukc\MongoODMFluent\MappingSet\SimpleMappingSet;
use yjiotpukc\MongoODMFluent\Tests\Stubs\EntityStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\EntityWithoutMappingStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\AnotherEntityStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\AnotherMappingStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\MappingStub;

class SimpleMappingSetTest extends TestCase
{
    public function testMappingExists()
    {
        $mappingSet = $this->createMappingSet();
        self::assertTrue($mappingSet->exists(EntityStub::class));
        self::assertTrue($mappingSet->exists(AnotherEntityStub::class));
        self::assertFalse($mappingSet->exists(EntityWithoutMappingStub::class));
    }

    protected function createMappingSet(): SimpleMappingSet
    {
        $mappingSet = new SimpleMappingSet();
        $mappingSet->add(EntityStub::class, MappingStub::class);
        $mappingSet->add(AnotherEntityStub::class, AnotherMappingStub::class);

        return $mappingSet;
    }

    public function testReturnsMapping()
    {
        $mappingSet = $this->createMappingSet();
        self::assertEquals(MappingStub::class, $mappingSet->find(EntityStub::class));
        self::assertEquals(AnotherMappingStub::class, $mappingSet->find(AnotherEntityStub::class));
    }

    public function testFailsIfNoMappingFound()
    {
        $entityClassName = EntityWithoutMappingStub::class;
        $this->expectException(MappingException::class);
        $this->expectExceptionMessage("Mapping for entity [$entityClassName] not found");
        $mappingSet = $this->createMappingSet();
        $mappingSet->find($entityClassName);
    }

    public function testReturnsAllMappings()
    {
        $mappingSet = $this->createMappingSet();
        self::assertEquals([EntityStub::class, AnotherEntityStub::class], $mappingSet->getAll());
    }
}
