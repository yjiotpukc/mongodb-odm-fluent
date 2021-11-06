<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Mapping;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;
use yjiotpukc\MongoODMFluent\Builder\EmbeddedDocument;

abstract class EmbeddedDocumentMapping implements Mapping
{
    public function load(ClassMetadata $metadata): void
    {
        $builder = new DocumentBuilder();
        $builder->embeddedDocument();
        $this->map($builder);
        $builder->build($metadata);
    }

    abstract public function map(EmbeddedDocument $builder): void;
}
