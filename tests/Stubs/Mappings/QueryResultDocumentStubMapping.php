<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings;

use yjiotpukc\MongoODMFluent\Document\QueryResultDocument;
use yjiotpukc\MongoODMFluent\Mapping\QueryResultDocumentMapping;

class QueryResultDocumentStubMapping implements QueryResultDocument
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

    public static function map(QueryResultDocumentMapping $mapping): void
    {
        static::$wasLoaded = true;
    }
}
