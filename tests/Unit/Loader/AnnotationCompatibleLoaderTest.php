<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Loader;

use Doctrine\Common\EventManager;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Loader\AnnotationCompatibleLoader;
use yjiotpukc\MongoODMFluent\MappingSet\SimpleMappingSet;
use yjiotpukc\MongoODMFluent\Tests\Stubs\SuperclassChildEntityStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\SuperclassEntityStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\EntityStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\SuperclassChildEntityStubMapping;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\SuperclassEntityStubMapping;

class AnnotationCompatibleLoaderTest extends SimpleLoaderTest
{
    protected function setUp(): void
    {
        $eventManager = $this->createMock(EventManager::class);
        $mappingSet = new SimpleMappingSet();
        $mappingSet->add(SuperclassEntityStub::class, SuperclassEntityStubMapping::class);
        $mappingSet->add(SuperclassChildEntityStub::class, SuperclassChildEntityStubMapping::class);
        $this->loader = new AnnotationCompatibleLoader($eventManager, $mappingSet);
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
