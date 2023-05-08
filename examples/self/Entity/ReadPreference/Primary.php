<?php

declare(strict_types=1);

namespace Examples\Entity\ReadPreference;

use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class Primary implements Document
{
    private string $id;

    public static function map(DocumentMapping $mapping): void
    {
        $mapping->id();
        $mapping->readPreference()->primary();
    }

    public static function isSuperclass(): bool
    {
        return false;
    }
}