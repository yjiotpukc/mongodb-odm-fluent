<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Mapping;

abstract class DocumentMapping implements Mapping
{
    final public function isTransient(): bool
    {
        return true;
    }
}
