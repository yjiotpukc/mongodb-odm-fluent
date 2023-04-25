<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Mapping\Loader;

use Doctrine\Common\EventManager;
use Doctrine\Persistence\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\FileBuilder;
use yjiotpukc\MongoODMFluent\Document\File;

class FileLoader implements Loader
{
    protected File $document;
    protected ClassMetadata $metadata;
    protected EventManager $eventManager;

    public function __construct(File $document, ClassMetadata $metadata, EventManager $eventManager)
    {
        $this->document = $document;
        $this->metadata = $metadata;
        $this->eventManager = $eventManager;
    }

    public function load(): void
    {
        $builder = new FileBuilder();
        $this->document::map($builder);
        $builder->build($this->metadata);
    }
}
