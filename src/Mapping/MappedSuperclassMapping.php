<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Mapping;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\MappedSuperclassBuilder;

abstract class MappedSuperclassMapping implements Mapping
{
    abstract public function map(MappedSuperclassBuilder $builder): void;

    public function load(ClassMetadata $metadata): void
    {
        $builder = new MappedSuperclassBuilder();
        $this->map($builder);
        $builder->build($metadata);
    }
}
