<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Mapping\Loader;

use Doctrine\Persistence\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;
use yjiotpukc\MongoODMFluent\Document\MappedSuperclass;
use yjiotpukc\MongoODMFluent\Mapping\Traits\LifecycleAutoMethodsTrait;

class MappedSuperclassLoader implements Loader
{
    use LifecycleAutoMethodsTrait;

    protected MappedSuperclass $document;
    protected ClassMetadata $metadata;

    public function __construct(MappedSuperclass $document, ClassMetadata $metadata)
    {
        $this->document = $document;
        $this->metadata = $metadata;
    }

    public function load(): void
    {
        $builder = new DocumentBuilder();
        $builder->mappedSuperclass();
        $this->document->map($builder);
        $this->addLifecycleAutoMethods($this->document, $builder);
        $builder->build($this->metadata);
    }
}
