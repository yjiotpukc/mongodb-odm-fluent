<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Mapping;

abstract class MappedSuperclassMapping implements Mapping
{
    final public function isTransient(): bool
    {
        return true;
    }
}
