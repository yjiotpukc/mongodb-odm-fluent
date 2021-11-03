<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Mapping;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\EmbeddedDocumentBuilder;

abstract class EmbeddedDocumentMapping implements Mapping
{
    abstract public function map(EmbeddedDocumentBuilder $builder): void;

    public function load(ClassMetadata $metadata): void
    {
        $builder = new EmbeddedDocumentBuilder();
        $this->map($builder);
        $builder->build($metadata);
    }
}
