<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration;

use Examples\Entity\AutoLifecycleEvents;
use yjiotpukc\MongoODMFluent\MappingFinder\MappingFinder;
use yjiotpukc\MongoODMFluent\MappingFinder\NamespacePatternMappingFinder;

class ExamplesNamespacePatternMappingTest extends AbstractIntegrationTestCase
{
    /** @dataProvider entityProvider */
    public function testMapping(string $className): void
    {
        $expectedMetadata = $this->getExpectedMetadata($className);
        $actualMetadata = $this->documentManager->getClassMetadata($className);

        self::assertEquals($expectedMetadata, $actualMetadata);
    }

    public function testEvents(): void
    {
        $this->documentManager->getClassMetadata(AutoLifecycleEvents::class);
        $events = $this->documentManager->getEventManager()->getListeners();

        self::assertEquals([
            'prePersist',
        ], array_keys($events));
    }

    public function entityProvider(): array
    {
        return array_map(static fn(string $className) => [$className], $this->driver->getAllClassNames());
    }

    protected function createMappingFinder(): MappingFinder
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
}
