<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings;

use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class SuperclassEntityStubMapping implements Document
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

    public static function map(DocumentMapping $mapping): void
    {
        static::$wasLoaded = true;
        $mapping->mappedSuperclass();
        $mapping->string('privateField');
        $mapping->string('protectedField');
        $mapping->string('publicField');
    }

    public static function isSuperclass(): bool
    {
        return true;
    }
}
