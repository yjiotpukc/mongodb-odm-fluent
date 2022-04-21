<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Mapping\Traits;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;

trait DocumentMappingTrait
{
    public function load(ClassMetadata $metadata): void
    {
        $builder = new DocumentBuilder();
        $this->map($builder);
        $builder->build($metadata);
    }

    abstract public function map(Document $builder): void;
}
