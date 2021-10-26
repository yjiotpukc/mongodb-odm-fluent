<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Stubs;

use yjiotpukc\MongoODMFluent\MappingFinder\MappingFinder;

class MappingFinderStub implements MappingFinder
{
    protected $mappings;

    public function __construct(array $mappings = [])
    {
        $this->mappings = $mappings;
    }

    public function find(string $entityClassName): string
    {
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
