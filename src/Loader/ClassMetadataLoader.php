<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Loader;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;
use yjiotpukc\MongoODMFluent\Document\EmbeddedDocument;
use yjiotpukc\MongoODMFluent\MappingSet\MappingSet;

class ClassMetadataLoader
{
    public function load(string $mapping, ClassMetadata $metadata): void
    {
        $builder = new DocumentBuilder();

        $implements = class_implements($mapping);
        if (in_array(EmbeddedDocument::class, $implements)) {
            $builder->embeddedDocument();
        }

        $mapping::map($builder);
        $builder->build($metadata);
    }
}
