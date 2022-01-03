<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration;

use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Id\AutoGenerator;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use PHPUnit\Framework\TestCase;
use yjiotpukc\MongoODMFluent\FluentDriver;
use yjiotpukc\MongoODMFluent\MappingFinder\NamespacePatternMappingFinder;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\Image;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\ImageMetadata;

class FileMappingTest extends TestCase
{
    protected static DocumentManager $documentManager;

    public static function setUpBeforeClass(): void
    {
        $mappingFinder = new NamespacePatternMappingFinder(
            '/^yjiotpukc\\\\MongoODMFluent\\\\Tests\\\\Integration\\\\Resources\\\\Mappings\\\\(.*)Mapping$/',
            'yjiotpukc\\\\MongoODMFluent\\\\Tests\\\\Integration\\\\Resources\\\\Entities\\\\$1',
            __DIR__ . '/Resources/Mappings/'
        );
        $driver = new FluentDriver($mappingFinder);
        $config = new Configuration();
        $config->setMetadataDriverImpl($driver);
        $config->setHydratorDir(__DIR__ . '/Resources/Hydrators/');
        $config->setHydratorNamespace('yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Hydrators');
        static::$documentManager = DocumentManager::create(null, $config);
    }

    public function testSimpleMapping(): void
    {
        $metadata = static::$documentManager->getClassMetadata(Image::class);

        $this->assertSimpleMappingIsCorrect($metadata);
    }

    protected function assertSimpleMappingIsCorrect(ClassMetadata $metadata): void
    {
        $expectedMetadata = new ClassMetadata(Image::class);
        $expectedMetadata->db = 'dbName';
        $expectedMetadata->bucketName = 'images';
        $expectedMetadata->collection = 'images.files';
        $expectedMetadata->mapField([
            'id' => true,
            'fieldName' => 'id',
            'strategy' => 'auto',
            'notSaved' => false,
        ]);
        $expectedMetadata->setIdGenerator(new AutoGenerator());
        $expectedMetadata->mapField([
            'association' => 3,
            'embedded' => true,
            'type' => 'one',
            'fieldName' => 'metadata',
            'targetDocument' => ImageMetadata::class,
            'name' => 'metadata',
            'isCascadeDetach' => true,
            'isCascadeMerge' => true,
            'isCascadePersist' => true,
            'isCascadeRefresh' => true,
            'isCascadeRemove' => true,
            'notSaved' => false,
        ]);

        self::assertEquals($expectedMetadata, $metadata);
    }
}
