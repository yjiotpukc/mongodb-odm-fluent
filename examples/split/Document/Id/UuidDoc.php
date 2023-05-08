<?php

declare(strict_types=1);

namespace Examples\Document\Id;

use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class UuidDoc implements Document
{
    public static function map(DocumentMapping $mapping): void
    {
        $mapping->id()->uuid()->salt('secret');
    }

    public static function isSuperclass(): bool
    {
        return false;
    }
}
