<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Loader;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Loader\AnnotationCompatibleClassMetadataLoader;
use yjiotpukc\MongoODMFluent\MappingSet\SimpleMappingSet;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Entity\SuperclassChildEntityStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Entity\SuperclassEntityStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\EntityStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\SuperclassChildEntityStubMapping;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\SuperclassEntityStubMapping;

class AnnotationCompatibleClassMetadataLoaderTest extends ClassMetadataLoaderTest
{
    protected function setUp(): void
    {
        $mappingSet = new SimpleMappingSet();
        $mappingSet->add(SuperclassEntityStub::class, SuperclassEntityStubMapping::class);
        $mappingSet->add(SuperclassChildEntityStub::class, SuperclassChildEntityStubMapping::class);
        $this->loader = new AnnotationCompatibleClassMetadataLoader($mappingSet);
        $this->metadata = new ClassMetadata(EntityStub::class);
    }

    public function testMappedSuperclassMetadataMapsOnlyPrivateFields(): void
    {
        $metadata = new ClassMetadata(SuperclassEntityStub::class);
        $this->loader->load(SuperclassEntityStubMapping::class, $metadata);

        $this->assertArrayHasKey('privateField', $metadata->fieldMappings);
        $this->assertArrayNotHasKey('protectedField', $metadata->fieldMappings);
        $this->assertArrayNotHasKey('publicField', $metadata->fieldMappings);
    }

    public function testMappedSuperclassChildMappingHasAllFieldsFromParent(): void
    {
        $metadata = new ClassMetadata(SuperclassChildEntityStub::class);
        $this->loader->load(SuperclassChildEntityStubMapping::class, $metadata);

        $this->assertArrayNotHasKey('privateField', $metadata->fieldMappings);
        $this->assertArrayHasKey('protectedField', $metadata->fieldMappings);
        $this->assertArrayHasKey('publicField', $metadata->fieldMappings);
    }
}
