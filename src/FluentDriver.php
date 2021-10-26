<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent;

use Doctrine\Persistence\Mapping\ClassMetadata;
use Doctrine\Persistence\Mapping\Driver\MappingDriver;
use yjiotpukc\MongoODMFluent\Mapping\Mapping;
use yjiotpukc\MongoODMFluent\MappingFinder\MappingFinder;

class FluentDriver implements MappingDriver
{
    /**
     * @var MappingFinder
     */
    private $mappingFinder;

    public function __construct(MappingFinder $mappingFinder)
    {
        $this->mappingFinder = $mappingFinder;
    }

    public function loadMetadataForClass($className, ClassMetadata $metadata): void
    {
        $this->createMapping($className)->load($metadata);
    }

    /**
     * @return string[]
     */
    public function getAllClassNames(): array
    {
        return $this->mappingFinder->getAll();
    }

    public function isTransient($className): bool
    {
        return !$this->mappingFinder->exists($className);
    }

    protected function createMapping(string $entityClassName): Mapping
    {
        $this->assertMappingExists($entityClassName);
        $mappingClassName = $this->mappingFinder->find($entityClassName);
        $this->assertMappingClassExists($mappingClassName);
        $mapping = new $mappingClassName();
        $this->assertMappingIsInstanceOfMapping($mapping);

        return $mapping;
    }

    protected function assertMappingExists(string $entityClassName): void
    {
        if (!$this->mappingFinder->exists($entityClassName)) {
            throw new MappingException("Mapping for entity [$entityClassName] not found");
        }
    }

    protected function assertMappingClassExists(string $mappingClassName): void
    {
        if (!class_exists($mappingClassName)) {
            throw new MappingException("[$mappingClassName] does not exist");
        }
    }

    protected function assertMappingIsInstanceOfMapping(object $mapping): void
    {
        $mappingClassName = get_class($mapping);
        if (!($mapping instanceof Mapping)) {
            throw new MappingException("[$mappingClassName] is not a mapping");
        }
    }
}
