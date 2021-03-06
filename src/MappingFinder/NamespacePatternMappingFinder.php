<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\MappingFinder;

use yjiotpukc\MongoODMFluent\Mapping\Mapping;
use yjiotpukc\MongoODMFluent\MappingSet\MappingSet;
use yjiotpukc\MongoODMFluent\MappingSet\SimpleMappingSet;
use yjiotpukc\MongoODMFluent\Util\ClassScanner;

class NamespacePatternMappingFinder implements MappingFinder
{
    protected string $entityClassReplacementPattern;
    protected string $mappingClassPattern;
    protected ClassScanner $classScanner;

    public function __construct(string $mappingClassPattern, string $entityClassReplacementPattern, string $mappingDirectory)
    {
        $this->mappingClassPattern = $mappingClassPattern;
        $this->entityClassReplacementPattern = $entityClassReplacementPattern;
        $this->classScanner = new ClassScanner($mappingDirectory);
    }

    public function makeMappingSet(): MappingSet
    {
        $classes = $this->classScanner->scanClasses();

        $mappingSet = new SimpleMappingSet();
        foreach ($classes as $className) {
            if (
                preg_match($this->mappingClassPattern, $className)
                && in_array(Mapping::class, class_implements($className), true)
            ) {
                $entityClassName = preg_replace($this->mappingClassPattern, $this->entityClassReplacementPattern, $className);
                $mappingSet->add($entityClassName, $className);
            }
        }

        return $mappingSet;
    }
}
