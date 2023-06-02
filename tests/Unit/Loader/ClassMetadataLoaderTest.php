<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Loader;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use PHPUnit\Framework\TestCase;
use yjiotpukc\MongoODMFluent\Loader\ClassMetadataLoader;
use yjiotpukc\MongoODMFluent\MappingSet\SimpleMappingSet;
use yjiotpukc\MongoODMFluent\Tests\Stubs\EntityStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\EntityStubMapping;

class ClassMetadataLoaderTest extends TestCase
{
    public function testLoadsDocumentMetadata(): void
    {
        $entity = EntityStub::class;
        $mappingSet = new SimpleMappingSet();
        $mappingSet->add($entity, EntityStubMapping::class);
        $loader = new ClassMetadataLoader($mappingSet);
        $loader->load($entity, new ClassMetadata($entity));
        self::assertTrue(EntityStubMapping::wasLoaded());
    }
}
