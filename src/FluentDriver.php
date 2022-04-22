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
    protected bool $useMappingInheritance = true;
    protected bool $useLifecycleAutoMethods = true;

    public function __construct(MappingFinder $mappingFinder)
    {
        $this->mappingSet = $mappingFinder->makeMappingSet();
    }

    public function disableMappingInheritance(): void
    {
        $this->useMappingInheritance = false;
    }

    public function disableLifecycleAutoMethods(): void
    {
        $this->useLifecycleAutoMethods = false;
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

        if ($this->useMappingInheritance) {
            $parentEntityClassName = $entityClassName;
            while ($parentEntityClassName = get_parent_class($parentEntityClassName)) {
                if ($this->mappingSet->exists($parentEntityClassName)) {
                    return $this->mappingSet->find($parentEntityClassName);
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
