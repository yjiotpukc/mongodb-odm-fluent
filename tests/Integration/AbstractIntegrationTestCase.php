<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration;

use Composer\Autoload\ClassLoader;
use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Doctrine\Persistence\Mapping\Driver\MappingDriver;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use yjiotpukc\MongoODMFluent\MappingFinder\MappingFinder;
use yjiotpukc\MongoODMFluent\MappingFinder\NamespacePatternMappingFinder;
use yjiotpukc\MongoODMFluent\MappingFinder\SelfMappingFinder;

abstract class AbstractIntegrationTestCase extends TestCase
{
    protected function createDocumentManager(MappingDriver $driver): DocumentManager
    {
        $config = new Configuration();
        $config->setMetadataDriverImpl($driver);
        $config->setHydratorDir($this->getVarDirectory() . '/Hydrator');
        $config->setHydratorNamespace('Hydrator');

        return DocumentManager::create(null, $config);
    }

    protected function registerAutoLoaderForExamples(string $subDir): void
    {
        $path = realpath(__DIR__ . '/../../vendor');
        $loader = ClassLoader::getRegisteredLoaders()[$path];
        $loader->addPsr4('Examples\\', $this->getExamplesDir() . "/$subDir");
    }

    protected function getExpectedMetadata(string $className): ClassMetadata
    {
        $shortClassName = (new ReflectionClass($className))->getShortName();
        $filename = str_replace('\\', '/', $shortClassName);
        $serialized = file_get_contents($this->getVarDirectory() . "/expectedMetadata/$filename");
        /** @var ClassMetadata $metadata */
        $metadata = unserialize($serialized);
        $this->addNotSerializedFields($metadata, $filename);

        return $metadata;
    }

    protected function addNotSerializedFields(ClassMetadata $metadata, string $filename): void
    {
        $filepath = $this->getVarDirectory() . "/expectedMetadata/notSerialized/$filename";
        if (file_exists($filepath)) {
            $notSerialized = unserialize(file_get_contents($filepath));
            if (isset($notSerialized['alsoLoadMethods'])) {
                $metadata->setAlsoLoadMethods($notSerialized['alsoLoadMethods']);
            }
        }
    }

    protected function getExamplesDir(): string
    {
        return realpath(__DIR__ . '/../../examples');
    }

    protected function getVarDirectory(): string
    {
        return realpath(__DIR__ . '/../../var');
    }
}
