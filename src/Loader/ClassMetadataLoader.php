<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Loader;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;
use yjiotpukc\MongoODMFluent\MappingSet\MappingSet;

class ClassMetadataLoader
{
    protected MappingSet $mappingSet;

    public function __construct(MappingSet $mappingSet)
    {
        $this->mappingSet = $mappingSet;
    }

    public function load(string $entity, ClassMetadata $metadata): void
    {
        $mapping = $this->mappingSet->find($entity);
        $builder = new DocumentBuilder();
        $mapping::map($builder);
        $builder->build($metadata);
    }
}
