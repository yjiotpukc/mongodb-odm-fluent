<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Buildable;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;

abstract class BuildableField implements Buildable
{
    public function build(ClassMetadata $metadata): void
    {
        $metadata->mapField($this->map());
    }

    abstract public function map(): array;
}
