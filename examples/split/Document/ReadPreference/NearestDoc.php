<?php

declare(strict_types=1);

namespace Examples\Document\ReadPreference;

use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class NearestDoc implements Document
{
    public static function map(DocumentMapping $mapping): void
    {
        $mapping->id();
        $mapping->readPreference()->nearest();
    }

    public static function isSuperclass(): bool
    {
        return false;
    }
}
