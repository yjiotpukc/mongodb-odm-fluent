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
    protected MappingSet $mappingSet;
    protected bool $checkParents = false;
    protected bool $useLifecycleAutoMethods = true;

    public function __construct(MappingFinder $mappingFinder)
    {
        $this->mappingSet = $mappingFinder->makeMappingSet();
    }

    public function checkParents(): void
    {
        $this->checkParents = true;
    }

    public function disableLifecycleAutoMethods(): void
    {
        $this->useLifecycleAutoMethods = true;
    }

    public function loadMetadataForClass($className, ClassMetadata $metadata): void
    {
        $this->createMapping($className)->load($metadata);
    }

    protected function createMapping(string $entityClassName): Mapping
    {
        $mappingClassName = $this->findMapping($entityClassName);
        $this->assertMappingClassExists($mappingClassName);
        $mapping = new $mappingClassName();
        $this->assertMappingIsInstanceOfMapping($mapping);

        if(method_exists($mapping, 'enableLifecycleAutoMethods')) {
            $mapping->enableLifecycleAutoMethods($this->useLifecycleAutoMethods);
        }

        return $mapping;
    }

    protected function findMapping(string $entityClassName): string
    {
        if ($this->mappingSet->exists($entityClassName)) {
            return $this->mappingSet->find($entityClassName);
        }

        if ($this->checkParents) {
            while ($entityClassName = get_parent_class($entityClassName)) {
                if ($this->mappingSet->exists($entityClassName)) {
                    return $this->mappingSet->find($entityClassName);
                }
            }
        }

        throw new MappingException("Mapping for entity [$entityClassName] not found");
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
