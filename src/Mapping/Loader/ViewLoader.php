<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Mapping\Loader;
use Doctrine\Persistence\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;
use yjiotpukc\MongoODMFluent\Document\View;
use yjiotpukc\MongoODMFluent\Mapping\Traits\LifecycleAutoMethodsTrait;

class ViewLoader implements Loader
{
    use LifecycleAutoMethodsTrait;

    protected View $document;
    protected ClassMetadata $metadata;

    public function __construct(View $document, ClassMetadata $metadata)
    {
        $this->document = $document;
        $this->metadata = $metadata;
    }

    public function load(): void
    {
        $builder = new DocumentBuilder();
        $this->document->map($builder);
        $this->addLifecycleAutoMethods($this->document, $builder);
        $builder->build($this->metadata);
    }
}
