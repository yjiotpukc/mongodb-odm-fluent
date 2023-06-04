<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Loader;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use PHPUnit\Framework\TestCase;
use yjiotpukc\MongoODMFluent\Loader\ClassMetadataLoader;
use yjiotpukc\MongoODMFluent\Tests\Stubs\EntityStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\EmbeddedEntityStubMapping;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\EntityStubMapping;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\SuperclassEntityStubMapping;

class ClassMetadataLoaderTest extends TestCase
{
    protected function setUp(): void
    {
        $this->loader = new ClassMetadataLoader();
        $this->metadata = new ClassMetadata(EntityStub::class);
    }

    public function testLoadsDocumentMetadata(): void
    {
        $this->loader->load(EntityStubMapping::class, $this->metadata);

        $this->assertTrue(EntityStubMapping::wasLoaded());
        $this->assertFalse($this->metadata->isEmbeddedDocument);
        $this->assertFalse($this->metadata->isMappedSuperclass);
        $this->assertFalse($this->metadata->isFile);
        $this->assertFalse($this->metadata->isView());
        $this->assertFalse($this->metadata->isQueryResultDocument);
    }

    public function testLoadsSuperclassDocumentMetadata(): void
    {
        $this->loader->load(SuperclassEntityStubMapping::class, $this->metadata);

        $this->assertTrue(SuperclassEntityStubMapping::wasLoaded());
        $this->assertFalse($this->metadata->isEmbeddedDocument);
        $this->assertTrue($this->metadata->isMappedSuperclass);
        $this->assertFalse($this->metadata->isFile);
        $this->assertFalse($this->metadata->isView());
        $this->assertFalse($this->metadata->isQueryResultDocument);
    }

    public function testLoadsEmbeddedDocumentMetadata(): void
    {
        $this->loader->load(EmbeddedEntityStubMapping::class, $this->metadata);

        $this->assertTrue(EmbeddedEntityStubMapping::wasLoaded());
        $this->assertTrue($this->metadata->isEmbeddedDocument);
        $this->assertFalse($this->metadata->isMappedSuperclass);
        $this->assertFalse($this->metadata->isFile);
        $this->assertFalse($this->metadata->isView());
        $this->assertFalse($this->metadata->isQueryResultDocument);
    }
}
