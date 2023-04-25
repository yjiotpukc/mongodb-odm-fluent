<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent;

use Doctrine\Common\EventManager;
use Doctrine\Persistence\Mapping\ClassMetadata;
use Doctrine\Persistence\Mapping\Driver\MappingDriver;
use ReflectionClass;
use yjiotpukc\MongoODMFluent\Mapping\Loader\DocumentLoader;
use yjiotpukc\MongoODMFluent\Mapping\MappingLoaderFactory;
use yjiotpukc\MongoODMFluent\MappingFinder\MappingFinder;
use yjiotpukc\MongoODMFluent\MappingSet\MappingSet;

class FluentDriver implements MappingDriver
{
    protected MappingSet $mappingSet;
    protected MappingLoaderFactory $loaderFactory;
    protected EventManager $eventManager;

    public function __construct(MappingFinder $mappingFinder)
    {
        $this->mappingSet = $mappingFinder->makeMappingSet();
        $this->loaderFactory = new MappingLoaderFactory();
    }

    public function setEventManager(EventManager $eventManager): void
    {
        $this->eventManager = $eventManager;
    }

    public function disableLifecycleAutoMethods(): void
    {
        $this->loaderFactory->disableLifecycleAutoMethods();
    }

    public function loadMetadataForClass($className, ClassMetadata $metadata): void
    {
        $mapping = $this->createMapping($className);
        $loader = $this->loaderFactory->createLoader($mapping, $metadata, $this->eventManager);
        if ($loader instanceof DocumentLoader) {
            $loader->setParents($this->findParentDocuments($className));
        }

        $loader->load();
    }

    public function findParentDocuments(string $className): array
    {
        $parent = new ReflectionClass($className);
        $parentDocuments = [];
        while ($parent = $parent->getParentClass()) {
            $parentDocuments[] = $this->findMapping($parent->getName());
        }

        return array_unique($parentDocuments);
    }

    protected function createMapping(string $entityClassName)
    {
        $mappingClassName = $this->findMapping($entityClassName);
        $this->assertMappingClassExists($mappingClassName);

        return new $mappingClassName();
    }

    protected function findMapping(string $entityClassName): string
    {
        if ($this->mappingSet->exists($entityClassName)) {
            return $this->mappingSet->find($entityClassName);
        }

        $parentEntityClassName = $entityClassName;
        while ($parentEntityClassName = get_parent_class($parentEntityClassName)) {
            if ($this->mappingSet->exists($parentEntityClassName)) {
                return $this->mappingSet->find($parentEntityClassName);
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
