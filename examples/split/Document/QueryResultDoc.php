<?php

declare(strict_types=1);

namespace Examples\Document;

use yjiotpukc\MongoODMFluent\Document\QueryResultDocument;
use yjiotpukc\MongoODMFluent\Mapping\QueryResultDocumentMapping;

class QueryResultDoc implements QueryResultDocument
{
    public static function map(QueryResultDocumentMapping $mapping): void
    {
        $mapping->int('count');
    }
}
