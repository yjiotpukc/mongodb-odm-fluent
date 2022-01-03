<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\MappingFinder;

use PHPUnit\Framework\TestCase;
use yjiotpukc\MongoODMFluent\MappingException;
use yjiotpukc\MongoODMFluent\MappingFinder\ListMappingFinder;
use yjiotpukc\MongoODMFluent\Tests\Stubs\AnotherEntityStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\EntityStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\AnotherEntityStubMapping;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\EntityStubMapping;

class ListMappingFinderTest extends TestCase
{
    public function testCreatesMappingSet()
    {
        $finder = new ListMappingFinder([EntityStubMapping::class, AnotherEntityStubMapping::class]);
        $mappingSet = $finder->makeMappingSet();
        self::assertEquals([EntityStub::class, AnotherEntityStub::class], $mappingSet->getAll());
    }

    public function testFailsIfClassIsNotMapping()
    {
        $className = EntityStub::class;
        $this->expectException(MappingException::class);
        $this->expectExceptionMessage("Class [{$className}] is not a mapping");
        $finder = new ListMappingFinder([$className]);
        $finder->makeMappingSet();
    }
}
