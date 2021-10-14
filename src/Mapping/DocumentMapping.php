<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Mapping;

use yjiotpukc\MongoODMFluent\Fluent\DocumentBuilder;

abstract class DocumentMapping implements Mapping
{
    abstract public function map(DocumentBuilder $builder): void;

    final public function isTransient(): bool
    {
        return true;
    }
}
