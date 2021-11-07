<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Stubs;

use yjiotpukc\MongoODMFluent\MappingFinder\MappingFinder;
use yjiotpukc\MongoODMFluent\MappingSet\MappingSet;
use yjiotpukc\MongoODMFluent\MappingSet\SimpleMappingSet;

class MappingFinderStub implements MappingFinder
{
    protected array $mappings;

    public function __construct(array $mappings = [])
    {
        $this->mappings = $mappings;
    }

    public function makeMappingSet(): MappingSet
    {
        $mappingSet = new SimpleMappingSet();
        foreach ($this->mappings as $entity => $mapping) {
            $mappingSet->add($entity, $mapping);
        }

        return $mappingSet;
    }
}
