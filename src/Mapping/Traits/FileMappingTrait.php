<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Mapping\Traits;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\FileBuilder;
use yjiotpukc\MongoODMFluent\Builder\File;

trait FileMappingTrait
{
    public function load(ClassMetadata $metadata): void
    {
        $builder = new FileBuilder();
        $this->map($builder);
        $builder->build($metadata);
    }

    abstract public function map(File $builder): void;
}
