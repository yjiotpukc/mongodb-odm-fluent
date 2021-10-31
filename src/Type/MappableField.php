<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\FluentBuilder;

abstract class MappableField implements FluentBuilder
{
    public function build(ClassMetadata $metadata): void
    {
        $metadata->mapField($this->map());
    }

    abstract public function map(): array;
}
