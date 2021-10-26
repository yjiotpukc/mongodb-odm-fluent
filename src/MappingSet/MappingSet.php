<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\MappingSet;

interface MappingSet
{
    public function exists(string $entityClassName): bool;

    public function find(string $entityClassName): string;

    public function getAll(): array;
}
