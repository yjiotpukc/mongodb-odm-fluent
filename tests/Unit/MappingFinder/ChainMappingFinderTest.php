<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\MappingFinder;

use PHPUnit\Framework\TestCase;
use yjiotpukc\MongoODMFluent\MappingFinder\ChainMappingFinder;
use yjiotpukc\MongoODMFluent\MappingFinder\ListMappingFinder;
use yjiotpukc\MongoODMFluent\Tests\Stubs\AnotherEntityStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\EntityStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\AnotherEntityStubMapping;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\EntityStubMapping;

class ChainMappingFinderTest extends TestCase
{
    public function testCreatesMappingSet(): void
    {
        $firstFinder = new ListMappingFinder([EntityStub::class => EntityStubMapping::class]);
        $secondFinder = new ListMappingFinder([AnotherEntityStub::class => AnotherEntityStubMapping::class]);
        $finder = new ChainMappingFinder([$firstFinder, $secondFinder]);

        $mappingSet = $finder->makeMappingSet();

        self::assertEquals([EntityStub::class, AnotherEntityStub::class], $mappingSet->getAll());
    }
}
