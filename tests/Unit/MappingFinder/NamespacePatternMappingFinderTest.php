<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\MappingFinder;

use PHPUnit\Framework\TestCase;
use yjiotpukc\MongoODMFluent\MappingFinder\NamespacePatternMappingFinder;
use yjiotpukc\MongoODMFluent\MappingSet\MappingSet;
use yjiotpukc\MongoODMFluent\Tests\Stubs\AnotherEntityStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\EntityStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\AnotherEntityStubMapping;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\EntityStubMapping;

class NamespacePatternMappingFinderTest extends TestCase
{
    public function testFindsMappings(): void
    {
        $mappingSet = $this->createMappingSet();
        self::assertEquals(EntityStubMapping::class, $mappingSet->find(EntityStub::class));
    }

    public function createMappingSet(): MappingSet
    {
        $finder = new NamespacePatternMappingFinder(
            '/^yjiotpukc\\\\MongoODMFluent\\\\Tests\\\\Stubs\\\\Mappings\\\\(.*)Mapping$/',
            'yjiotpukc\\\\MongoODMFluent\\\\Tests\\\\Stubs\\\\$1',
            $this->getDirectoryPath()
        );

        return $finder->makeMappingSet();
    }

    protected function getDirectoryPath(): string
    {
        return realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Stubs/Mappings');
    }

    public function testFindsMappingsInSubdirectories(): void
    {
        $mappingSet = $this->createMappingSet();
        self::assertEquals(AnotherEntityStubMapping::class, $mappingSet->find(AnotherEntityStub::class));
    }

    public function testFindsOnlyMappings(): void
    {
        $mappingSet = $this->createMappingSet();
        self::assertEquals([EntityStub::class, AnotherEntityStub::class, \yjiotpukc\MongoODMFluent\Tests\Stubs\SomeNamespace\EntityStub::class], $mappingSet->getAll());
    }
}
