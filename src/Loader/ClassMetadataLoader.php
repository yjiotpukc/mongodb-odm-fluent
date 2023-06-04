<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Loader;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;
use yjiotpukc\MongoODMFluent\Builder\Document\FileBuilder;
use yjiotpukc\MongoODMFluent\Document\EmbeddedDocument;
use yjiotpukc\MongoODMFluent\Document\File;

class ClassMetadataLoader
{
    public function load(string $mapping, ClassMetadata $metadata): void
    {
        $implements = class_implements($mapping);
        if (in_array(File::class, $implements)) {
            $builder = new FileBuilder();
        } else {
            $builder = new DocumentBuilder();

            if (in_array(EmbeddedDocument::class, $implements)) {
                $builder->embeddedDocument();
            }
        }

        $mapping::map($builder);
        $builder->build($metadata);
    }
}
