<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration;

use Composer\Autoload\ClassLoader;
use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\Persistence\Mapping\ClassMetadata;
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

    protected function createNamespacePatternMappingFinder(): MappingFinder
    {
        $this->registerAutoLoaderForExamples('split');

        $mappingPattern = '/^Examples\\\\Document\\\\(.*)Doc$/';
        $replacementPattern = 'Examples\\\\Entity\\\\$1';

        return new NamespacePatternMappingFinder(
            $mappingPattern,
            $replacementPattern,
            $this->getExamplesDir() . '/split/Document'
        );
    }

    protected function createSelfMappingFinder(): MappingFinder
    {
        $this->registerAutoLoaderForExamples('self');

        return new SelfMappingFinder($this->getExamplesDir() . '/self/Entity');
    }

    protected function registerAutoLoaderForExamples(string $subDir): void
    {
        $loader = ClassLoader::getRegisteredLoaders()['/home/yjiotpukc/code/php/mongodb-odm-fluent/vendor'];
        $loader->addPsr4('Examples\\', $this->getExamplesDir() . "/$subDir");
    }

    protected function getExpectedMetadata(string $className): ClassMetadata
    {
        $shortClassName = (new ReflectionClass($className))->getShortName();
        $filename = str_replace('\\', '/', $shortClassName);
        $serialized = file_get_contents($this->getVarDirectory() . "/expectedMetadata/$filename");

        return unserialize($serialized);
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
