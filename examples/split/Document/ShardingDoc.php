<?php

declare(strict_types=1);

namespace Examples\Document;

use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class ShardingDoc implements Document
{
    public static function map(DocumentMapping $mapping): void
    {
        $mapping->id();
        $mapping->string('shardKey1');
        $mapping->string('shardKey2');
        $mapping->shard()
            ->asc('shardKey1')
            ->desc('shardKey2')
            ->unique()
            ->numInitialChunks(10);
    }
}
