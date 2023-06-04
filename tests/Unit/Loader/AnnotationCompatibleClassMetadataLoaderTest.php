<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Loader;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Loader\AnnotationCompatibleClassMetadataLoader;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Entity\SuperclassEntityStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\EntityStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\SuperclassEntityStubMapping;

class AnnotationCompatibleClassMetadataLoaderTest extends ClassMetadataLoaderTest
{
    protected function setUp(): void
    {
        $this->loader = new AnnotationCompatibleClassMetadataLoader();
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
}
