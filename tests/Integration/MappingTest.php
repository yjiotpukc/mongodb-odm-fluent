<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration;

use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Id\AutoGenerator;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use PHPUnit\Framework\TestCase;
use yjiotpukc\MongoODMFluent\FluentDriver;
use yjiotpukc\MongoODMFluent\MappingFinder\DirectoryMappingFinder;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\Bird;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\Dog;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\Pet;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\Phone;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\SimpleEntity;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\User;

class MappingTest extends TestCase
{
    /**
     * @var DocumentManager
     */
    protected static $documentManager;

    public static function setUpBeforeClass(): void
    {
        $mappingFinder = new DirectoryMappingFinder(
            [__DIR__ . '/Resources/Mappings/'],
            ['yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Mappings']
        );
        $driver = new FluentDriver($mappingFinder);
        $config = new Configuration();
        $config->setMetadataDriverImpl($driver);
        $config->setHydratorDir(__DIR__ . '/Resources/Hydrators/');
        $config->setHydratorNamespace('yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Hydrators');
        static::$documentManager = DocumentManager::create(null, $config);
    }

    public function testSimpleMapping()
    {
        $metadata = static::$documentManager->getClassMetadata(SimpleEntity::class);

        $this->assertSimpleMappingIsCorrect($metadata);
    }

    protected function assertSimpleMappingIsCorrect(ClassMetadata $metadata)
    {
        $expectedMetadata = new ClassMetadata(SimpleEntity::class);
        $expectedMetadata->db = 'dbName';
        $expectedMetadata->collection = 'simple';
        $expectedMetadata->mapField([
            'id' => true,
            'fieldName' => 'id',
            'strategy' => 'auto',
            'notSaved' => false,
        ]);
        $expectedMetadata->setIdGenerator(new AutoGenerator());
        $expectedMetadata->mapField([
            'fieldName' => 'name',
            'type' => 'string',
            'nullable' => false,
            'notSaved' => false,
            'name' => 'name',
        ]);

        self::assertEquals($expectedMetadata, $metadata);
    }

    public function testMappingWithEmbeddedField()
    {
        $metadata = static::$documentManager->getClassMetadata(User::class);

        $this->assertMappingWithEmbeddedFieldIsCorrect($metadata);
    }

    protected function assertMappingWithEmbeddedFieldIsCorrect(ClassMetadata $metadata)
    {
        $expectedMetadata = new ClassMetadata(User::class);
        $expectedMetadata->db = 'dbName';
        $expectedMetadata->collection = 'users';
        $expectedMetadata->mapField([
            'id' => true,
            'fieldName' => 'id',
            'strategy' => 'auto',
            'notSaved' => false,
        ]);
        $expectedMetadata->setIdGenerator(new AutoGenerator());
        $expectedMetadata->mapField([
            'fieldName' => 'name',
            'type' => 'string',
            'nullable' => false,
            'notSaved' => false,
            'name' => 'name',
        ]);
        $expectedMetadata->mapManyEmbedded([
            'fieldName' => 'phones',
            'notSaved' => false,
            'targetDocument' => Phone::class,
        ]);

        self::assertEquals($expectedMetadata, $metadata);
    }

    public function testEmbeddedMapping()
    {
        $metadata = static::$documentManager->getClassMetadata(Phone::class);

        $this->assertEmbeddedMappingIsCorrect($metadata);
    }

    protected function assertEmbeddedMappingIsCorrect(ClassMetadata $metadata)
    {
        $expectedMetadata = new ClassMetadata(Phone::class);
        $expectedMetadata->setIdGenerator(new AutoGenerator());
        $expectedMetadata->isEmbeddedDocument = true;
        $expectedMetadata->mapField([
            'fieldName' => 'phoneNumber',
            'type' => 'string',
            'nullable' => false,
            'notSaved' => false,
            'name' => 'phoneNumber',
        ]);

        self::assertEquals($expectedMetadata, $metadata);
    }

    public function testSuperclassMapping()
    {
        $metadata = static::$documentManager->getClassMetadata(Pet::class);

        $this->assertSuperclassMappingIsCorrect($metadata);
    }

    protected function assertSuperclassMappingIsCorrect(ClassMetadata $metadata)
    {
        $expectedMetadata = new ClassMetadata(Pet::class);
        $expectedMetadata->db = 'dbName';
        $expectedMetadata->collection = 'pets';
        $expectedMetadata->isMappedSuperclass = true;
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
            'notSaved' => false,
        ]);
        $expectedMetadata->setIdGenerator(new AutoGenerator());
        $expectedMetadata->mapField([
            'fieldName' => 'name',
            'type' => 'string',
            'nullable' => false,
            'notSaved' => false,
            'name' => 'name',
        ]);

        self::assertEquals($expectedMetadata, $metadata);
    }

    public function testFirstChildClassMapping()
    {
        $metadata = static::$documentManager->getClassMetadata(Dog::class);

        $this->assertFirstChildClassMappingIsCorrect($metadata);
    }

    protected function assertFirstChildClassMappingIsCorrect(ClassMetadata $metadata)
    {
        $expectedMetadata = new ClassMetadata(Dog::class);
        $expectedMetadata->db = 'dbName';
        $expectedMetadata->collection = 'pets';
        $expectedMetadata->isMappedSuperclass = false;
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
        ]);
        $expectedMetadata->setIdGenerator(new AutoGenerator());
        $expectedMetadata->mapField([
            'fieldName' => 'name',
            'type' => 'string',
            'nullable' => false,
            'notSaved' => false,
            'name' => 'name',
            'declared' => Pet::class,
        ]);
        $expectedMetadata->mapField([
            'fieldName' => 'breed',
            'type' => 'string',
            'nullable' => false,
            'notSaved' => false,
            'name' => 'breed',
        ]);

        self::assertEquals($expectedMetadata, $metadata);
    }

    public function testSecondChildClassMapping()
    {
        $metadata = static::$documentManager->getClassMetadata(Bird::class);

        $this->assertSecondChildClassMappingIsCorrect($metadata);
    }

    protected function assertSecondChildClassMappingIsCorrect(ClassMetadata $metadata)
    {
        $expectedMetadata = new ClassMetadata(Bird::class);
        $expectedMetadata->db = 'dbName';
        $expectedMetadata->collection = 'pets';
        $expectedMetadata->isMappedSuperclass = false;
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
        ]);
        $expectedMetadata->setIdGenerator(new AutoGenerator());
        $expectedMetadata->mapField([
            'fieldName' => 'name',
            'type' => 'string',
            'nullable' => false,
            'notSaved' => false,
            'name' => 'name',
            'declared' => Pet::class,
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
}
