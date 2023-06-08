<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration;

use yjiotpukc\MongoODMFluent\MappingFinder\MappingFinder;
use yjiotpukc\MongoODMFluent\MappingFinder\SelfMappingFinder;

class ExamplesSelfMappingTest extends AbstractIntegrationTestCase
{
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

    protected function createMappingFinder(): MappingFinder
    {
        $this->registerAutoLoaderForExamples('self');

        return new SelfMappingFinder($this->getExamplesDir() . '/self/Entity');
    }
}
