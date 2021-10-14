<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Mapping;

abstract class EmbeddedDocumentMapping implements Mapping
{
    final public function isTransient(): bool
    {
        return false;
    }
}
