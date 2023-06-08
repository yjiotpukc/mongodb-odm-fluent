<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent;

use Doctrine\Common\EventManager;
use Doctrine\Persistence\Mapping\ClassMetadata;
use Doctrine\Persistence\Mapping\Driver\MappingDriver;
use ReflectionClass;
use ReflectionException;
use yjiotpukc\MongoODMFluent\Loader\ClassMetadataLoader;
use yjiotpukc\MongoODMFluent\Mapping\Mapping;
use yjiotpukc\MongoODMFluent\MappingFinder\MappingFinder;
use yjiotpukc\MongoODMFluent\MappingSet\MappingSet;

class FluentDriver implements MappingDriver
{
    protected MappingSet $mappingSet;
    protected EventManager $eventManager;
    protected ClassMetadataLoader $loader;

    public function __construct(MappingFinder $mappingFinder, ClassMetadataLoader $loader)
    {
        $this->mappingSet = $mappingFinder->makeMappingSet();
        $this->loader = $loader;
    }

    public function setEventManager(EventManager $eventManager): void
    {
        $this->eventManager = $eventManager;
    }

    public function loadMetadataForClass($className, ClassMetadata $metadata): void
    {
        $mapping = $this->createMapping($className);
        $this->loader->load($mapping, $metadata);
    }

    protected function createMapping(string $entityClassName): string
    {
        $mappingClassName = $this->findMapping($entityClassName);
        $this->assertMappingClassExists($mappingClassName);

        $implements = class_implements($mappingClassName);
        if (!in_array(Mapping::class, $implements, true)) {
            throw new MappingException("[$mappingClassName] is not a mapping");
        }

        return $mappingClassName;
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
