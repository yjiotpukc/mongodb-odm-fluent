<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\MappingFinder;

use PHPUnit\Framework\TestCase;
use yjiotpukc\MongoODMFluent\MappingFinder\SelfMappingFinder;
use yjiotpukc\MongoODMFluent\MappingSet\MappingSet;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\AnotherEntityStubMapping;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\EntityStubMapping;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\SomeNamespace\EntityStubMapping as NamespacedEntityStubMapping;

class SelfMappingFinderTest extends TestCase
{
    public function testFindsMappings(): void
    {
        $mappingSet = $this->createMappingSet();
        self::assertEquals([EntityStubMapping::class, AnotherEntityStubMapping::class, NamespacedEntityStubMapping::class], $mappingSet->getAll());
    }

    protected function createMappingSet(): MappingSet
    {
        return (new SelfMappingFinder($this->getDirectoryPath()))->makeMappingSet();
    }

    protected function getDirectoryPath(): string
    {
        return realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Stubs/Mappings');
    }
}
