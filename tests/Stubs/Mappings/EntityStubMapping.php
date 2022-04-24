<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings;

use yjiotpukc\MongoODMFluent\Document\Document;

class EntityStubMapping implements Document
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

    public function map(\yjiotpukc\MongoODMFluent\Builder\Document $builder): void
    {
        static::$wasLoaded = true;
    }
}
