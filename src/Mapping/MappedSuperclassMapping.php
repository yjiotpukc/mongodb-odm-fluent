<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Mapping;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Fluent\MappedSuperclassBuilder;

abstract class MappedSuperclassMapping implements Mapping
{
    abstract public function map(MappedSuperclassBuilder $builder): void;

    public function load(ClassMetadata $metadata): void
    {
        $builder = $this->createBuilder();
        $this->map($builder);
        $builder->build($metadata);
    }

    final public function isTransient(): bool
    {
        return true;
    }

    final public function createBuilder(): MappedSuperclassBuilder
    {
        return new MappedSuperclassBuilder();
    }
}
