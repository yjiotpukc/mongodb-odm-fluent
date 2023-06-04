<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings;

use yjiotpukc\MongoODMFluent\Document\File;
use yjiotpukc\MongoODMFluent\Mapping\FileMapping;

class FileStubMapping implements File
{
    protected static bool $wasLoaded = false;

    public static function wasLoaded(): bool
    {
        return static::$wasLoaded;
    }

    public static function reset(): void
    {
        static::$wasLoaded = false;
    }

    public static function map(FileMapping $mapping): void
    {
        static::$wasLoaded = true;
    }
}
