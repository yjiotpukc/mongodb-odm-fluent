<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Util;

class DirectoryScanner
{
    protected string $mappingDirectory;
    protected array $scannedClasses;

    public function __construct(string $mappingDirectory)
    {
        $this->mappingDirectory = $mappingDirectory;
    }

    /**
     * Returns scanned classes
     *
     * @return string[]
     */
    public function scanDirectory(): array
    {
        if (!isset($this->scannedClasses)) {
            $oldClasses = get_declared_classes();

            $this->scanDirectoryRecursive($this->mappingDirectory);

            $newClasses = get_declared_classes();
            $this->scannedClasses = array_diff($newClasses, $oldClasses);
        }

        return $this->scannedClasses;
    }

    protected function scanDirectoryRecursive(string $dirPath): void
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
            }
        }
    }
}
