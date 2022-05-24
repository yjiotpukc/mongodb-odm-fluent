<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Mapping\Loader;

use Doctrine\Persistence\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;
use yjiotpukc\MongoODMFluent\Document\QueryResultDocument;
use yjiotpukc\MongoODMFluent\Mapping\Traits\LifecycleAutoMethodsTrait;

class QueryResultDocumentLoader implements Loader
{
    use LifecycleAutoMethodsTrait;

    protected QueryResultDocument $document;
    protected ClassMetadata $metadata;

    public function __construct(QueryResultDocument $document, ClassMetadata $metadata)
    {
        $this->document = $document;
        $this->metadata = $metadata;
    }

    public function load(): void
    {
        $builder = new DocumentBuilder();
        $builder->queryResultDocument();
        $this->document->map($builder);
        $this->addLifecycleAutoMethods($this->document, $builder);
        $builder->build($this->metadata);
    }
}
