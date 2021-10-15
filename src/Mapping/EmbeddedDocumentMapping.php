<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Mapping;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\EmbeddedDocumentBuilder;

abstract class EmbeddedDocumentMapping implements Mapping
{
    abstract public function map(EmbeddedDocumentBuilder $builder): void;

    public function load(ClassMetadata $metadata): void
    {
        $builder = $this->createBuilder();
        $this->map($builder);
        $builder->build($metadata);
    }

    final public function isTransient(): bool
    {
        return false;
    }

    final public function createBuilder(): EmbeddedDocumentBuilder
    {
        return new EmbeddedDocumentBuilder();
    }
}
