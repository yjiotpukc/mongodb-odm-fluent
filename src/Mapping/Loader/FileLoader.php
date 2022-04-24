<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Mapping\Loader;

use Doctrine\Persistence\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\FileBuilder;
use yjiotpukc\MongoODMFluent\Document\File;

class FileLoader implements Loader
{
    protected File $document;
    protected ClassMetadata $metadata;

    public function __construct(File $document, ClassMetadata $metadata)
    {
        $this->document = $document;
        $this->metadata = $metadata;
    }

    public function load(): void
    {
        $builder = new FileBuilder();
        $this->document->map($builder);
        $builder->build($this->metadata);
    }
}
