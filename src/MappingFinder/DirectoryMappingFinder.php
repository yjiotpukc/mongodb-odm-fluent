<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\MappingFinder;

use yjiotpukc\MongoODMFluent\Mapping\Mapping;

class DirectoryMappingFinder implements MappingFinder
{
    protected $mappings;

    public function __construct(array $mappingDirectories, array $mappingNamespaces)
    {
        $this->scanMappingDirectories($mappingDirectories);
        $this->registerMappings($mappingNamespaces);
    }

    public function find(string $entityClassName): string
    {
        return $this->mappings[$entityClassName];
    }

    public function getAll(): array
    {
        return array_values($this->mappings);
    }

    protected function scanMappingDirectories(array $mappingDirs)
    {
        foreach ($mappingDirs as $mappingDir) {
            $this->scanDir($mappingDir);
        }
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
                $this->scanDir($dirPath);
            } elseif (str_ends_with($dirPath, '.php')) {
                require_once $absolutePath;
            }
        }
    }

    protected function registerMappings(array $mappingNamespaces)
    {
        $declaredClasses = get_declared_classes();
        foreach ($declaredClasses as $declaredClass) {
            $isMappingNamespace = false;
            foreach ($mappingNamespaces as $namespace) {
                if (str_starts_with($declaredClass, $namespace)) {
                    $isMappingNamespace = true;
                    break;
                }
            }

            if ($isMappingNamespace) {
                $instance = new $declaredClass();
                if ($instance instanceof Mapping) {
                    $this->mappings[$instance->mapFor()] = $declaredClass;
                }
            }
        }
    }
}
