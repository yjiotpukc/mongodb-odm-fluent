<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\MappingFinder;

use yjiotpukc\MongoODMFluent\Mapping\Mapping;
use yjiotpukc\MongoODMFluent\MappingSet\MappingSet;
use yjiotpukc\MongoODMFluent\MappingSet\SimpleMappingSet;

class NamespacePatternMappingFinder implements MappingFinder
{
    protected string $entityClassReplacementPattern;
    protected string $mappingClassPattern;
    protected string $mappingDirectory;
    protected bool $isDirectoryScanned = false;

    public function __construct(string $mappingClassPattern, string $entityClassReplacementPattern, string $mappingDirectory)
    {
        $this->mappingClassPattern = $mappingClassPattern;
        $this->entityClassReplacementPattern = $entityClassReplacementPattern;
        $this->mappingDirectory = $mappingDirectory;
    }

    public function makeMappingSet(): MappingSet
    {
        $this->scanDirectory();
        $mappingSet = new SimpleMappingSet();
        $this->addMappingsToSet($mappingSet);

        return $mappingSet;
    }

    protected function scanDirectory(): void
    {
        if (!$this->isDirectoryScanned) {
            $this->scanDir($this->mappingDirectory);
            $this->isDirectoryScanned = true;
        }
    }

    protected function scanDir(string $dirPath): void
    {
        $inner = scandir($dirPath);
        foreach ($inner as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }

            $absolutePath = $dirPath . DIRECTORY_SEPARATOR . $item;
            if (is_dir($absolutePath)) {
                $this->scanDir($absolutePath);
            } elseif (str_ends_with($absolutePath, '.php')) {
                require_once $absolutePath;
            }
        }
    }

    protected function addMappingsToSet(SimpleMappingSet $mappingSet): void
    {
        $declaredClasses = get_declared_classes();
        foreach ($declaredClasses as $declaredClass) {
            if (preg_match($this->mappingClassPattern, $declaredClass)) {
                $instance = new $declaredClass();
                if ($instance instanceof Mapping) {
                    $entityClassName = preg_replace($this->mappingClassPattern, $this->entityClassReplacementPattern, $declaredClass);
                    $mappingSet->add($entityClassName, $declaredClass);
                }
            }
        }
    }
}
