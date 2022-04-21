<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration;

use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Id\AutoGenerator;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use PHPUnit\Framework\TestCase;
use yjiotpukc\MongoODMFluent\FluentDriver;
use yjiotpukc\MongoODMFluent\MappingException;
use yjiotpukc\MongoODMFluent\MappingFinder\NamespacePatternMappingFinder;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\Bird;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\Dog;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\Parrot;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\Pet;

class DescendantMappingTest extends TestCase
{
    public function testThrowsWhenNotCheckingParents(): void
    {
        $this->expectException(MappingException::class);
        $this->expectExceptionMessage('Mapping for entity [yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\Parrot] not found');

        $documentManager = $this->createDocumentManager(false);
        $documentManager->getClassMetadata(Parrot::class);
    }

    public function testDescendantMapping(): void
    {
        $documentManager = $this->createDocumentManager(true);
        $metadata = $documentManager->getClassMetadata(Parrot::class);

        $this->assertDescendantMappingIsCorrect($metadata);
    }

    public function assertDescendantMappingIsCorrect($metadata): void
    {
        $expectedMetadata = new ClassMetadata(Parrot::class);
        $expectedMetadata->db = 'dbName';
        $expectedMetadata->collection = 'pets';
        $expectedMetadata->isMappedSuperclass = false;
        $expectedMetadata->rootDocumentName = Bird::class;
        $expectedMetadata->setParentClasses([Bird::class]);
        $expectedMetadata->setInheritanceType(ClassMetadata::INHERITANCE_TYPE_SINGLE_COLLECTION);
        $expectedMetadata->setDiscriminatorField('type');
        $expectedMetadata->setDiscriminatorMap([
            'dog' => Dog::class,
            'bird' => Bird::class,
        ]);
        $expectedMetadata->mapField([
            'id' => true,
            'fieldName' => 'id',
            'strategy' => 'auto',
            'declared' => Pet::class,
            'notSaved' => false,
            'inherited' => Bird::class,
        ]);
        $expectedMetadata->setIdGenerator(new AutoGenerator());
        $expectedMetadata->mapField([
            'fieldName' => 'name',
            'type' => 'string',
            'nullable' => false,
            'notSaved' => false,
            'name' => 'name',
            'declared' => Pet::class,
            'inherited' => Bird::class,
        ]);
        $expectedMetadata->mapField([
            'fieldName' => 'isTalking',
            'type' => 'boolean',
            'nullable' => false,
            'notSaved' => false,
            'name' => 'isTalking',
        ]);

        self::assertEquals($expectedMetadata, $metadata);
    }

    private function createDocumentManager(bool $checkParents): DocumentManager
    {
        $mappingFinder = new NamespacePatternMappingFinder(
            '/^yjiotpukc\\\\MongoODMFluent\\\\Tests\\\\Integration\\\\Resources\\\\Mappings\\\\(.*)Mapping$/',
            'yjiotpukc\\\\MongoODMFluent\\\\Tests\\\\Integration\\\\Resources\\\\Entities\\\\$1',
            __DIR__ . '/Resources/Mappings/'
        );
        $driver = new FluentDriver($mappingFinder);
        if ($checkParents) {
            $driver->checkParents();
        }
        $config = new Configuration();
        $config->setMetadataDriverImpl($driver);
        $config->setHydratorDir(__DIR__ . '/Resources/Hydrators/');
        $config->setHydratorNamespace('yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Hydrators');
        return DocumentManager::create(null, $config);
    }
}
