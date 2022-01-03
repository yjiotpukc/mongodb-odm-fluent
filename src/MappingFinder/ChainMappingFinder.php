<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\MappingFinder;

use yjiotpukc\MongoODMFluent\MappingSet\MappingSet;
use yjiotpukc\MongoODMFluent\MappingSet\SimpleMappingSet;

class ChainMappingFinder implements MappingFinder
{
    /** @var MappingFinder[] */
    protected array $mappingFinders;

    /**
     * @param MappingFinder[] $mappingFinders
     */
    public function __construct(array $mappingFinders)
    {
        $this->mappingFinders = $mappingFinders;
    }

    public function makeMappingSet(): MappingSet
    {
        $mappingSet = new SimpleMappingSet();

        foreach ($this->mappingFinders as $mappingFinder) {
            $partialSet = $mappingFinder->makeMappingSet();
            foreach ($partialSet->getAll() as $entityClassName) {
                $mappingSet->add($entityClassName, $partialSet->find($entityClassName));
            }
        }

        return $mappingSet;
    }
}
