<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\MappingFinder;

use yjiotpukc\MongoODMFluent\Mapping\Mapping;
use yjiotpukc\MongoODMFluent\MappingSet\MappingSet;
use yjiotpukc\MongoODMFluent\MappingSet\SimpleMappingSet;
use yjiotpukc\MongoODMFluent\Util\ClassScanner;

class SelfMappingFinder implements MappingFinder
{
    protected ClassScanner $classScanner;

    public function __construct(string $mappingDirectory)
    {
        $this->classScanner = new ClassScanner($mappingDirectory);
    }

    public function makeMappingSet(): MappingSet
    {
        $classes = $this->classScanner->scanClasses();

        $mappingSet = new SimpleMappingSet();
        foreach ($classes as $className) {
            if (in_array(Mapping::class, class_implements($className), true)) {
                $mappingSet->add($className, $className);
            }
        }

        return $mappingSet;
    }
}
