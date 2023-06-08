<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings;

use yjiotpukc\MongoODMFluent\Document\EmbeddedDocument;
use yjiotpukc\MongoODMFluent\Mapping\EmbeddedDocumentMapping;

class EmbeddedEntityStubMapping implements EmbeddedDocument
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

    public static function map(EmbeddedDocumentMapping $mapping): void
    {
        static::$wasLoaded = true;
    }
}
