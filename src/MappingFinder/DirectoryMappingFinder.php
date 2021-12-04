<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\MappingFinder;

use yjiotpukc\MongoODMFluent\Mapping\Mapping;
use yjiotpukc\MongoODMFluent\MappingSet\MappingSet;
use yjiotpukc\MongoODMFluent\MappingSet\SimpleMappingSet;

class DirectoryMappingFinder implements MappingFinder
{
    /** @var string[] */
    protected array $mappingDirectories;
    /** @var string[] */
    protected array $mappingNamespaces;
    protected bool $wereDirectoriesScanned = false;

    public function __construct(array $mappingDirectories, array $mappingNamespaces)
    {
        $this->mappingDirectories = $mappingDirectories;
        $this->mappingNamespaces = $mappingNamespaces;
    }

    public function makeMappingSet(): MappingSet
    {
        $mappingSet = new SimpleMappingSet();

        if (!$this->wereDirectoriesScanned) {
            $this->scanMappingDirectories();
        }

        $this->addMappingsToSet($mappingSet);

        return $mappingSet;
    }

    protected function scanMappingDirectories()
    {
        foreach ($this->mappingDirectories as $mappingDir) {
            $this->scanDir($mappingDir);
        }

        $this->wereDirectoriesScanned = true;
    }

    protected function scanDir(string $dirPath)
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

    protected function addMappingsToSet(SimpleMappingSet $mappingSet)
    {
        $declaredClasses = get_declared_classes();
        foreach ($declaredClasses as $declaredClass) {
            $isMappingNamespace = false;
            foreach ($this->mappingNamespaces as $namespace) {
                if (str_starts_with($declaredClass, $namespace)) {
                    $isMappingNamespace = true;
                    break;
                }
            }

            if ($isMappingNamespace) {
                $instance = new $declaredClass();
                if ($instance instanceof Mapping) {
                    $mappingSet->add($instance->mapFor(), $declaredClass);
                }
            }
        }
    }
}
