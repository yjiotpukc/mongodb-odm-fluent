<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\MappingFinder;

interface MappingFinder
{
    /**
     * Returns Mapping class name for entity
     *
     * @param string $entityClassName
     * @return string
     */
    public function find(string $entityClassName): string;

    public function exists(string $entityClassName): bool;

    /**
     * Gets the names of all mapped classes known to this finder
     *
     * @return string[]
     */
    public function getAll(): array;
}
