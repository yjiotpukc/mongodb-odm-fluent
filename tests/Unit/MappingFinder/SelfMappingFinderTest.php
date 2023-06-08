<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\MappingFinder;

use PHPUnit\Framework\TestCase;
use yjiotpukc\MongoODMFluent\MappingFinder\SelfMappingFinder;
use yjiotpukc\MongoODMFluent\MappingSet\MappingSet;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\AnotherEntityStubMapping;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\EmbeddedEntityStubMapping;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\EntityStubMapping;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\FileStubMapping;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\QueryResultDocumentStubMapping;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\SomeNamespace\EntityStubMapping as NamespacedEntityStubMapping;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\SuperclassChildEntityStubMapping;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\SuperclassEntityStubMapping;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\ViewStubMapping;

class SelfMappingFinderTest extends TestCase
{
    public function testFindsMappings(): void
    {
        $mappingSet = $this->createMappingSet();
        $expectedMappings = [
            EntityStubMapping::class,
            SuperclassEntityStubMapping::class,
            EmbeddedEntityStubMapping::class,
            FileStubMapping::class,
            ViewStubMapping::class,
            QueryResultDocumentStubMapping::class,
            SuperclassChildEntityStubMapping::class,
            AnotherEntityStubMapping::class,
            NamespacedEntityStubMapping::class,
        ];

        self::assertEquals($expectedMappings, $mappingSet->getAll());
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
