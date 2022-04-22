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
        $documentManager = $this->createDocumentManager(true);
        $metadata = $documentManager->getClassMetadata(LifecycleAutoMethodsMapping::class);

        $this->assertMappingIsCorrect($metadata, true);
    }

    public function testDisabledLifecycleAutoMethods(): void
    {
        $documentManager = $this->createDocumentManager(false);
        $metadata = $documentManager->getClassMetadata(LifecycleAutoMethodsMapping::class);

        $this->assertMappingIsCorrect($metadata, false);
    }

    protected function assertMappingIsCorrect(ClassMetadata $metadata, bool $useLifecycleAutoMethods): void
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

        if ($useLifecycleAutoMethods) {
            $expectedMetadata->addLifecycleCallback('preLoad', 'preLoad');
        }

        self::assertEquals($expectedMetadata, $metadata);
    }

    protected function createDocumentManager(bool $useLifecycleAutoMethods): DocumentManager
    {
        $mappingFinder = new SelfMappingFinder(__DIR__ . '/Resources/Mappings/');
        $driver = new FluentDriver($mappingFinder);
        if (!$useLifecycleAutoMethods) {
            $driver->disableLifecycleAutoMethods();
        }
        $config = new Configuration();
        $config->setMetadataDriverImpl($driver);
        $config->setHydratorDir(__DIR__ . '/Resources/Hydrators/');
        $config->setHydratorNamespace('yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Hydrators');

        return DocumentManager::create(null, $config);
    }
}
