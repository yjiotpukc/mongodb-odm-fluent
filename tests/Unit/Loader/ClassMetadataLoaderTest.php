<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Loader;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use PHPUnit\Framework\TestCase;
use yjiotpukc\MongoODMFluent\Loader\ClassMetadataLoader;
use yjiotpukc\MongoODMFluent\Tests\Stubs\EntityStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\EntityStubMapping;

class ClassMetadataLoaderTest extends TestCase
{
    public function testLoadsDocumentMetadata(): void
    {
        $entity = EntityStub::class;
        $mapping = EntityStubMapping::class;
        $loader = new ClassMetadataLoader();
        $loader->load($mapping, new ClassMetadata($entity));
        self::assertTrue(EntityStubMapping::wasLoaded());
    }
}
