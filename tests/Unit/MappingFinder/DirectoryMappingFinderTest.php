<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\MappingFinder;

use PHPUnit\Framework\TestCase;
use yjiotpukc\MongoODMFluent\MappingFinder\DirectoryMappingFinder;
use yjiotpukc\MongoODMFluent\MappingSet\MappingSet;
use yjiotpukc\MongoODMFluent\Tests\Stubs\AnotherEntityStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\EntityStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\AnotherEntityStubMapping;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\EntityStubMapping;

class DirectoryMappingFinderTest extends TestCase
{
    public const NAMESPACE = 'yjiotpukc\MongoODMFluent\Tests\Stubs';

    public function testFindsMappings()
    {
        $mappingSet = $this->createMappingSet();
        self::assertEquals(EntityStubMapping::class, $mappingSet->find(EntityStub::class));
    }

    public function createMappingSet(): MappingSet
    {
        $finder = new DirectoryMappingFinder([$this->getDirectoryPath()], [self::NAMESPACE]);

        return $finder->makeMappingSet();
    }

    protected function getDirectoryPath(): string
    {
        return realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Stubs');
    }

    public function testFindsMappingsInSubdirectories()
    {
        $mappingSet = $this->createMappingSet();
        self::assertEquals(AnotherEntityStubMapping::class, $mappingSet->find(AnotherEntityStub::class));
    }

    public function testFindsOnlyMappings()
    {
        $mappingSet = $this->createMappingSet();
        self::assertEquals([EntityStub::class, AnotherEntityStub::class, \yjiotpukc\MongoODMFluent\Tests\Stubs\SomeNamespace\EntityStub::class], $mappingSet->getAll());
    }
}
