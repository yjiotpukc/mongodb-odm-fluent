<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Loader;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;
use yjiotpukc\MongoODMFluent\MappingSet\MappingSet;

class ClassMetadataLoader
{
    public function load(string $mapping, ClassMetadata $metadata): void
    {
        $builder = new DocumentBuilder();
        $mapping::map($builder);
        $builder->build($metadata);
    }
}
