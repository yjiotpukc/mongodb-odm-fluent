<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Mapping;

use yjiotpukc\MongoODMFluent\Fluent\MappedSuperclassBuilder;

abstract class MappedSuperclassMapping implements Mapping
{
    abstract public function map(MappedSuperclassBuilder $builder): void;

    final public function isTransient(): bool
    {
        return true;
    }
}
