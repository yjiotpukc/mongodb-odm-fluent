<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Mapping\Loader;

use Doctrine\Common\EventManager;
use Doctrine\Persistence\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;
use yjiotpukc\MongoODMFluent\Document\View;
use yjiotpukc\MongoODMFluent\Mapping\Traits\LifecycleAutoMethodsTrait;

class ViewLoader implements Loader
{
    use LifecycleAutoMethodsTrait;

    protected View $document;
    protected ClassMetadata $metadata;
    protected EventManager $eventManager;

    public function __construct(View $document, ClassMetadata $metadata, EventManager $eventManager)
    {
        $this->document = $document;
        $this->metadata = $metadata;
        $this->eventManager = $eventManager;
    }

    public function load(): void
    {
        $builder = new DocumentBuilder();
        $this->document::map($builder);
        $this->addLifecycleAutoMethods($builder);
        $builder->build($this->metadata);
    }
}
