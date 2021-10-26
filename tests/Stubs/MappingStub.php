<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Stubs;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Mapping\Mapping;

class MappingStub implements Mapping
{
    protected static $wasLoaded = false;

    public function mapFor(): string
    {
        return EntityStub::class;
    }

    public function load(ClassMetadata $metadata): void
    {
        static::$wasLoaded = true;
    }

    public function createBuilder()
    {
    }

    public static function wasLoaded(): bool
    {
        return static::$wasLoaded;
    }

    public static function reset(): void
    {
        static::$wasLoaded = false;
    }
}
