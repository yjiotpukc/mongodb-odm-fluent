<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Field;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Builder;

abstract class BuilderField implements Builder
{
    public function build(ClassMetadata $metadata): void
    {
        $metadata->mapField($this->map());
    }

    abstract public function map(): array;
}
