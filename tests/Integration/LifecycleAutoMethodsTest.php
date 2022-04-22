<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration;

use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Id\AutoGenerator;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use PHPUnit\Framework\TestCase;
use yjiotpukc\MongoODMFluent\FluentDriver;
use yjiotpukc\MongoODMFluent\MappingFinder\SelfMappingFinder;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Mappings\LifecycleAutoMethodsMapping;

class LifecycleAutoMethodsTest extends TestCase
{
    protected static DocumentManager $documentManager;

    public function testLifecycleAutoMethods(): void
    {
        $documentManager = $this->createDocumentManager();
        $metadata = $documentManager->getClassMetadata(LifecycleAutoMethodsMapping::class);

        $this->assertMappingIsCorrect($metadata);
    }

    protected function assertMappingIsCorrect(ClassMetadata $metadata): void
    {
        $expectedMetadata = new ClassMetadata(LifecycleAutoMethodsMapping::class);
        $expectedMetadata->db = 'dbName';
        $expectedMetadata->collection = 'simple';
        $expectedMetadata->mapField([
            'id' => true,
            'fieldName' => 'id',
            'strategy' => 'auto',
            'notSaved' => false,
        ]);
        $expectedMetadata->setIdGenerator(new AutoGenerator());
        $expectedMetadata->addLifecycleCallback('preLoad', 'preLoad');

        self::assertEquals($expectedMetadata, $metadata);
    }

    protected function createDocumentManager(): DocumentManager
    {
        $mappingFinder = new SelfMappingFinder(__DIR__ . '/Resources/Mappings/');
        $driver = new FluentDriver($mappingFinder);
        $driver->disableLifecycleAutoMethods();
        $config = new Configuration();
        $config->setMetadataDriverImpl($driver);
        $config->setHydratorDir(__DIR__ . '/Resources/Hydrators/');
        $config->setHydratorNamespace('yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Hydrators');

        return DocumentManager::create(null, $config);
    }
}
