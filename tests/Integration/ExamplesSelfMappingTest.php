<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration;

use Doctrine\ODM\MongoDB\DocumentManager;
use yjiotpukc\MongoODMFluent\FluentDriver;
use yjiotpukc\MongoODMFluent\Loader\AnnotationCompatibleLoader;
use yjiotpukc\MongoODMFluent\MappingFinder\MappingFinder;
use yjiotpukc\MongoODMFluent\MappingFinder\SelfMappingFinder;

class ExamplesSelfMappingTest extends AbstractIntegrationTestCase
{
    private FluentDriver $driver;
    private DocumentManager $documentManager;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $finder = $this->createSelfMappingFinder();
        $loader = new AnnotationCompatibleLoader($finder->makeMappingSet());
        $this->driver = new FluentDriver($finder, $loader);
        $this->documentManager = $this->createDocumentManager($this->driver);
        $this->driver->setEventManager($this->documentManager->getEventManager());
    }

    /** @dataProvider entityProvider */
    public function testMapping(string $className): void
    {
        $expectedMetadata = $this->getExpectedMetadata($className);
        $actualMetadata = $this->documentManager->getClassMetadata($className);

        self::assertEquals($expectedMetadata, $actualMetadata);
    }

    public function entityProvider(): array
    {
        return array_map(static fn(string $className) => [$className], $this->driver->getAllClassNames());
    }

    private function createSelfMappingFinder(): MappingFinder
    {
        $this->registerAutoLoaderForExamples('self');

        return new SelfMappingFinder($this->getExamplesDir() . '/self/Entity');
    }
}
