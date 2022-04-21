<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Util;

use ReflectionClass;

class ClassScanner
{
    protected string $mappingDirectory;
    protected array $scannedClasses;
    private array $files = [];

    public function __construct(string $mappingDirectory)
    {
        if (str_ends_with($mappingDirectory, '/')) {
            $mappingDirectory = substr($mappingDirectory, 0, -1);
        }
        $this->mappingDirectory = $mappingDirectory;
    }

    /**
     * Returns scanned classes
     *
     * @return string[]
     */
    public function scanClasses(): array
    {
        if (!isset($this->scannedClasses)) {
            $files = $this->scanDirectoryRecursive($this->mappingDirectory);
            $this->scannedClasses = $this->findClassesInFiles($files);
        }

        return $this->scannedClasses;
    }

    protected function scanDirectoryRecursive(string $dirPath): array
    {
        $inner = scandir($dirPath);
        foreach ($inner as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }

            $absolutePath = $dirPath . DIRECTORY_SEPARATOR . $item;
            if (is_dir($absolutePath)) {
                $this->scanDirectoryRecursive($absolutePath);
            } elseif (str_ends_with($absolutePath, '.php')) {
                require_once $absolutePath;
                $this->files[] = $absolutePath;
            }
        }

        return $this->files;
    }

    protected function findClassesInFiles(array $files): array
    {
        $scannedClasses = [];
        $classes = get_declared_classes();
        foreach ($classes as $className) {
            $reflection = new ReflectionClass($className);
            if (in_array($reflection->getFileName(), $files, true)) {
                $scannedClasses[] = $className;
            }
        }

        return $scannedClasses;
    }
}
