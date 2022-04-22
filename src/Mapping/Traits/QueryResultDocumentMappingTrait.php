<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Mapping\Traits;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;
use yjiotpukc\MongoODMFluent\Builder\QueryResultDocument;

trait QueryResultDocumentMappingTrait
{
    use LifecycleAutoMethodsTrait;

    public function load(ClassMetadata $metadata): void
    {
        $builder = new DocumentBuilder();
        $builder->queryResultDocument();
        $this->map($builder);
        $this->addLifecycleAutoMethods($builder);
        $builder->build($metadata);
    }

    abstract public function map(QueryResultDocument $builder): void;
}
