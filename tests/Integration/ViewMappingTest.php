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
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\User;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\UserName;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Repositories\UserNameRepository;

class ViewMappingTest extends TestCase
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
        $metadata = static::$documentManager->getClassMetadata(UserName::class);

        $this->assertSimpleMappingIsCorrect($metadata);
    }

    protected function assertSimpleMappingIsCorrect(ClassMetadata $metadata): void
    {
        $expectedMetadata = new ClassMetadata(UserName::class);
        $expectedMetadata->markViewOf(User::class);
        $expectedMetadata->setCustomRepositoryClass(UserNameRepository::class);
        $expectedMetadata->setIdGenerator(new AutoGenerator());
        $expectedMetadata->mapField([
            'fieldName' => 'name',
            'name' => 'name',
            'type' => 'string',
            'notSaved' => false,
            'strategy' => 'set',
            'nullable' => false,
            'isCascadeRemove' => false,
            'isCascadePersist' => false,
            'isCascadeRefresh' => false,
            'isCascadeMerge' => false,
            'isCascadeDetach' => false,
            'isOwningSide' => true,
            'isInverseSide' => false,
        ]);

        self::assertEquals($expectedMetadata, $metadata);
    }
}
