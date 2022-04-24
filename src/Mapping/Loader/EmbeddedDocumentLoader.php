<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Mapping\Loader;

use Doctrine\Persistence\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;
use yjiotpukc\MongoODMFluent\Document\EmbeddedDocument;
use yjiotpukc\MongoODMFluent\Mapping\Traits\LifecycleAutoMethodsTrait;

class EmbeddedDocumentLoader implements Loader
{
    use LifecycleAutoMethodsTrait;

    protected EmbeddedDocument $document;
    protected ClassMetadata $metadata;

    public function __construct(EmbeddedDocument $document, ClassMetadata $metadata)
    {
        $this->document = $document;
        $this->metadata = $metadata;
    }

    public function load(): void
    {
        $builder = new DocumentBuilder();
        $builder->embeddedDocument();
        $this->document->map($builder);
        $this->addLifecycleAutoMethods($builder);
        $builder->build($this->metadata);
    }
}
