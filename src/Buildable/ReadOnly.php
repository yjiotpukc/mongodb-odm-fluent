<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Buildable;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;

class ReadOnly implements Buildable
{
    public function build(ClassMetadata $metadata): void
    {
        $metadata->markReadOnly();
    }
}
