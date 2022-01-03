<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Mapping\Mapping;

class EntityStubMapping implements Mapping
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

    public function load(ClassMetadata $metadata): void
    {
        static::$wasLoaded = true;
    }
}
