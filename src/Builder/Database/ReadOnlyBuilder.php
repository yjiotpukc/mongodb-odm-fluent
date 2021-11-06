<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Database;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Builder;

class ReadOnlyBuilder implements Builder
{
    public function build(ClassMetadata $metadata): void
    {
        $metadata->markReadOnly();
    }
}
