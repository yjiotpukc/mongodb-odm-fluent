<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent;

use Doctrine\Persistence\Mapping\ClassMetadata;
use Doctrine\Persistence\Mapping\Driver\MappingDriver;
use yjiotpukc\MongoODMFluent\Mapping\Mapping;
use yjiotpukc\MongoODMFluent\MappingFinder\MappingFinder;
use yjiotpukc\MongoODMFluent\MappingSet\MappingSet;

class FluentDriver implements MappingDriver
{
    /**
     * @var MappingSet
     */
    protected $mappingSet;

    public function __construct(MappingFinder $mappingFinder)
    {
        $this->mappingSet = $mappingFinder->makeMappingSet();
    }

    public function loadMetadataForClass($className, ClassMetadata $metadata): void
    {
        $this->createMapping($className)->load($metadata);
    }

    protected function createMapping(string $entityClassName): Mapping
    {
        $this->assertMappingExists($entityClassName);
        $mappingClassName = $this->mappingSet->find($entityClassName);
        $this->assertMappingClassExists($mappingClassName);
        $mapping = new $mappingClassName();
        $this->assertMappingIsInstanceOfMapping($mapping);

        return $mapping;
    }

    protected function assertMappingExists(string $entityClassName): void
    {
        if (!$this->mappingSet->exists($entityClassName)) {
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

    /**
     * @return string[]
     */
    public function getAllClassNames(): array
    {
        return $this->mappingSet->getAll();
    }

    public function isTransient($className): bool
    {
        return !$this->mappingSet->exists($className);
    }
}
