<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Loader;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use PHPUnit\Framework\TestCase;
use yjiotpukc\MongoODMFluent\Loader\ClassMetadataLoader;
use yjiotpukc\MongoODMFluent\Tests\Stubs\EntityStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\EmbeddedEntityStubMapping;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\EntityStubMapping;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\FileStubMapping;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\QueryResultDocumentStubMapping;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\SuperclassChildDocumentStubMapping;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\SuperclassEntityStubMapping;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\ViewStubMapping;

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
        $this->assertTrue($this->metadata->isMappedSuperclass);
        $this->assertFalse($this->metadata->isEmbeddedDocument);
        $this->assertFalse($this->metadata->isFile);
        $this->assertFalse($this->metadata->isView());
        $this->assertFalse($this->metadata->isQueryResultDocument);
    }

    public function testLoadsEmbeddedDocumentMetadata(): void
    {
        $this->loader->load(EmbeddedEntityStubMapping::class, $this->metadata);

        $this->assertTrue(EmbeddedEntityStubMapping::wasLoaded());
        $this->assertFalse($this->metadata->isMappedSuperclass);
        $this->assertTrue($this->metadata->isEmbeddedDocument);
        $this->assertFalse($this->metadata->isFile);
        $this->assertFalse($this->metadata->isView());
        $this->assertFalse($this->metadata->isQueryResultDocument);
    }

    public function testLoadsFileMetadata(): void
    {
        $this->loader->load(FileStubMapping::class, $this->metadata);

        $this->assertTrue(FileStubMapping::wasLoaded());
        $this->assertFalse($this->metadata->isMappedSuperclass);
        $this->assertFalse($this->metadata->isEmbeddedDocument);
        $this->assertTrue($this->metadata->isFile);
        $this->assertFalse($this->metadata->isView());
        $this->assertFalse($this->metadata->isQueryResultDocument);
    }

    public function testLoadsView(): void
    {
        $this->loader->load(ViewStubMapping::class, $this->metadata);

        $this->assertTrue(ViewStubMapping::wasLoaded());
        $this->assertFalse($this->metadata->isMappedSuperclass);
        $this->assertFalse($this->metadata->isEmbeddedDocument);
        $this->assertFalse($this->metadata->isFile);
        $this->assertTrue($this->metadata->isView());
        $this->assertFalse($this->metadata->isQueryResultDocument);
    }

    public function testLoadsQueryResultDocument(): void
    {
        $this->loader->load(QueryResultDocumentStubMapping::class, $this->metadata);

        $this->assertTrue(QueryResultDocumentStubMapping::wasLoaded());
        $this->assertFalse($this->metadata->isMappedSuperclass);
        $this->assertFalse($this->metadata->isEmbeddedDocument);
        $this->assertFalse($this->metadata->isFile);
        $this->assertFalse($this->metadata->isView());
        $this->assertTrue($this->metadata->isQueryResultDocument);
    }

    public function testSuperclassChildDocumentIsNotSuperclass(): void
    {
        $this->loader->load(SuperclassChildDocumentStubMapping::class, $this->metadata);

        $this->assertTrue(SuperclassChildDocumentStubMapping::wasLoaded());
        $this->assertFalse($this->metadata->isMappedSuperclass);
        $this->assertFalse($this->metadata->isEmbeddedDocument);
        $this->assertFalse($this->metadata->isFile);
        $this->assertFalse($this->metadata->isView());
        $this->assertFalse($this->metadata->isQueryResultDocument);
    }
}