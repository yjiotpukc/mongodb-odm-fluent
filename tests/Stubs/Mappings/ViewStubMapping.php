<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings;

use yjiotpukc\MongoODMFluent\Document\View;
use yjiotpukc\MongoODMFluent\Mapping\ViewMapping;
use yjiotpukc\MongoODMFluent\Tests\Stubs\EntityStub;

class ViewStubMapping implements View
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

    public static function map(ViewMapping $mapping): void
    {
        static::$wasLoaded = true;
        $mapping
            ->rootClass(EntityStub::class)
            ->view('view');
    }
}
