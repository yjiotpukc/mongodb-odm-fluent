<?php

declare(strict_types=1);

namespace Examples\Entity;

use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class Misc implements Document
{
    private string $id;
    private string $shardKey;

    public static function map(DocumentMapping $mapping): void
    {
        $mapping->id();
        $mapping->string('shardKey');
        $mapping->readOnly();
        $mapping->writeConcern('majority');
        $mapping->readPreference()->secondaryPreferred();
        $mapping->index('id');
        $mapping->shard()->asc('shardKey');
        $mapping->alsoLoad('alsoLoad', ['field']);
    }

    public static function isSuperclass(): bool
    {
        return false;
    }

    public function alsoLoad(string $field): void
    {
    }
}
