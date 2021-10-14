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
        $mapping = $this->createMapping($className);

        return $mapping->isTransient();
    }

    protected function createMapping(string $entityClassName): Mapping
    {
        $mappingClassName = $this->mappingFinder->find($entityClassName);

        $mapping = new $mappingClassName();
        if (!($mapping instanceof Mapping)) {
            throw new MappingException("[$mappingClassName] is not a mapping");
        }

        return $mapping;
    }
}
