<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\MappingSet;

use yjiotpukc\MongoODMFluent\MappingException;

class SimpleMappingSet implements MappingSet
{
    protected $mappings;

    public function __construct()
    {
        $this->mappings = [];
    }

    public function add(string $entityClassName, string $mappingClassName)
    {
        $this->mappings[$entityClassName] = $mappingClassName;
    }

    public function find(string $entityClassName): string
    {
        if (!$this->exists($entityClassName)) {
            throw new MappingException("Mapping for entity [$entityClassName] not found");
        }

        return $this->mappings[$entityClassName];
    }

    public function exists(string $entityClassName): bool
    {
        return isset($this->mappings[$entityClassName]);
    }

    public function getAll(): array
    {
        return array_keys($this->mappings);
    }
}
