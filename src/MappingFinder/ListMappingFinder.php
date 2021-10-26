<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\MappingFinder;

use yjiotpukc\MongoODMFluent\Mapping\Mapping;
use yjiotpukc\MongoODMFluent\MappingException;
use yjiotpukc\MongoODMFluent\MappingSet\MappingSet;
use yjiotpukc\MongoODMFluent\MappingSet\SimpleMappingSet;

class ListMappingFinder implements MappingFinder
{
    protected $mappingClassNames;

    public function __construct(array $mappingClassNames)
    {
        $this->mappingClassNames = $mappingClassNames;
    }

    public function makeMappingSet(): MappingSet
    {
        $mappingSet = new SimpleMappingSet();

        foreach ($this->mappingClassNames as $mappingClassName) {
            $mapping = new $mappingClassName();
            if (!($mapping instanceof Mapping)) {
                throw new MappingException("Class [{$mappingClassName}] is not a mapping");
            }

            $mappingSet->add($mapping->mapFor(), $mappingClassName);
        }

        return $mappingSet;
    }
}
