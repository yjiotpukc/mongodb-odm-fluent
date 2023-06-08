<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent;

use Doctrine\Common\EventManager;
use Doctrine\Persistence\Mapping\ClassMetadata;
use Doctrine\Persistence\Mapping\Driver\MappingDriver;
use ReflectionClass;
use ReflectionException;
use yjiotpukc\MongoODMFluent\Loader\ClassMetadataLoader;
use yjiotpukc\MongoODMFluent\Mapping\Loader\DocumentLoader;
use yjiotpukc\MongoODMFluent\Mapping\Mapping;
use yjiotpukc\MongoODMFluent\Mapping\MappingLoaderFactory;
use yjiotpukc\MongoODMFluent\MappingFinder\MappingFinder;
use yjiotpukc\MongoODMFluent\MappingSet\MappingSet;

class FluentDriver implements MappingDriver
{
    protected MappingSet $mappingSet;
    protected MappingLoaderFactory $loaderFactory;
    protected EventManager $eventManager;
    protected ClassMetadataLoader $loader;

    public function __construct(MappingFinder $mappingFinder, ClassMetadataLoader $loader)
    {
        $this->mappingSet = $mappingFinder->makeMappingSet();
        $this->loader = $loader;
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

        $implements = class_implements($mappingClassName);
        if (!in_array(Mapping::class, $implements, true)) {
            throw new MappingException("[$mappingClassName] is not a mapping");
        }

        return new $mappingClassName();
    }

    protected function findMapping(string $entityClassName): ?string
    {
        if (!$this->mappingSet->exists($entityClassName)) {
            return null;
        }

        return $this->mappingSet->find($entityClassName);
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
        $mapping = $this->findMapping($className);

        return $mapping === null || !$this->hasOwnMapMethod($mapping);
    }

    protected function hasOwnMapMethod(string $className): bool
    {
        try {
            $reflObject = new ReflectionClass($className);
            $mapMethod = $reflObject->getMethod('map');
            $declaredIn = $mapMethod->getDeclaringClass()->getName();

            return $className === $declaredIn;
        } catch (ReflectionException $exception) {
            return false;
        }
    }
}
