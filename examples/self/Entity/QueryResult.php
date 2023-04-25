<?php

declare(strict_types=1);

namespace Examples\Entity;

use yjiotpukc\MongoODMFluent\Document\QueryResultDocument;
use yjiotpukc\MongoODMFluent\Mapping\QueryResultDocumentMapping;

class QueryResult implements QueryResultDocument
{
    private int $count;

    public static function map(QueryResultDocumentMapping $mapping): void
    {
        $mapping->int('count');
    }
}
