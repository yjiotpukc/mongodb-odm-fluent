<?php

declare(strict_types=1);

namespace Examples\Entity;

use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class Sharding implements Document
{
    private string $id;
    private string $shardKey1;
    private string $shardKey2;

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

    public static function isSuperclass(): bool
    {
        return false;
    }
}
