<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Loader;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use PHPUnit\Framework\TestCase;
use yjiotpukc\MongoODMFluent\Loader\ClassMetadataLoader;
use yjiotpukc\MongoODMFluent\Tests\Stubs\EntityStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\EmbeddedEntityStubMapping;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\EntityStubMapping;

class ClassMetadataLoaderTest extends TestCase
{
    public function testLoadsDocumentMetadata(): void
    {
        $entity = EntityStub::class;
        $mapping = EntityStubMapping::class;
        $loader = new ClassMetadataLoader();
        $metadata = new ClassMetadata($entity);
        $loader->load($mapping, $metadata);

        $this->assertTrue(EntityStubMapping::wasLoaded());
        $this->assertFalse($metadata->isEmbeddedDocument);
        $this->assertFalse($metadata->isMappedSuperclass);
        $this->assertFalse($metadata->isFile);
        $this->assertFalse($metadata->isView());
        $this->assertFalse($metadata->isQueryResultDocument);
    }

    public function testLoadsEmbeddedDocumentMetadata(): void
    {
        $entity = EntityStub::class;
        $mapping = EmbeddedEntityStubMapping::class;
        $loader = new ClassMetadataLoader();
        $metadata = new ClassMetadata($entity);
        $loader->load($mapping, $metadata);

        $this->assertTrue(EmbeddedEntityStubMapping::wasLoaded());
        $this->assertTrue($metadata->isEmbeddedDocument);
        $this->assertFalse($metadata->isMappedSuperclass);
        $this->assertFalse($metadata->isFile);
        $this->assertFalse($metadata->isView());
        $this->assertFalse($metadata->isQueryResultDocument);
    }
}
