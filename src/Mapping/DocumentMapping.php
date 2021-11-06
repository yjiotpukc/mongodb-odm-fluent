<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Mapping;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;

abstract class DocumentMapping implements Mapping
{
    public function load(ClassMetadata $metadata): void
    {
        $builder = new DocumentBuilder();
        $this->map($builder);
        $builder->build($metadata);
    }

    abstract public function map(DocumentBuilder $builder): void;
}
