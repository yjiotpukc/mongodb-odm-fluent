<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Mapping;

use yjiotpukc\MongoODMFluent\Fluent\EmbeddedDocumentBuilder;

abstract class EmbeddedDocumentMapping implements Mapping
{
    abstract public function map(EmbeddedDocumentBuilder $builder): void;

    final public function isTransient(): bool
    {
        return false;
    }
}
