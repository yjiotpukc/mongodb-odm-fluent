<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Mapping\Loader;

use Doctrine\Persistence\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;
use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\Traits\LifecycleAutoMethodsTrait;

class DocumentLoader implements Loader
{
    use LifecycleAutoMethodsTrait;

    protected Document $document;
    protected ClassMetadata $metadata;

    public function __construct(Document $document, ClassMetadata $metadata)
    {
        $this->document = $document;
        $this->metadata = $metadata;
    }

    public function load(): void
    {
        $builder = new DocumentBuilder();
        $this->document->map($builder);
        $this->addLifecycleAutoMethods($builder);
        $builder->build($this->metadata);
    }
}
