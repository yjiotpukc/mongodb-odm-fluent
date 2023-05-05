<?php

declare(strict_types=1);

namespace Examples\Document;

use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class MiscDoc implements Document
{
    public static function map(DocumentMapping $mapping): void
    {
        $mapping->id();
        $mapping->string('shardKey');
        $mapping->readOnly();
        $mapping->writeConcern('majority');
        $mapping->readPreference()->secondaryPreferred();
        $mapping->index('id');
        $mapping->shard()->asc('shardKey')->unique();
        $mapping->changeTrackingPolicy()->notify();
    }

    public static function isSuperclass(): bool
    {
        return false;
    }
}
