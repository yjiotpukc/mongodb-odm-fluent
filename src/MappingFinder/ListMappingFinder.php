<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\MappingFinder;

use yjiotpukc\MongoODMFluent\Mapping\Mapping;
use yjiotpukc\MongoODMFluent\MappingException;

class ListMappingFinder implements MappingFinder
{
    protected $mappings;

    public function __construct(array $mappingClassNames)
    {
        $this->mappings = [];

        foreach ($mappingClassNames as $mappingClassName) {
            $mapping = new $mappingClassName();
            if (!($mapping instanceof Mapping)) {
                throw new MappingException("Class {$mappingClassName} is not a mapping");
            }

            $this->mappings[$mapping->mapFor()] = $mappingClassName;
        }
    }

    public function find(string $entityClassName): string
    {
        return $this->mappings[$entityClassName];
    }

    public function getAll(): array
    {
        return array_values($this->mappings);
    }
}
