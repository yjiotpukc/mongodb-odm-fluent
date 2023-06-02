<?php

declare(strict_types=1);

namespace Examples\Document\Id;

use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class NoneDoc implements Document
{
    public static function map(DocumentMapping $mapping): void
    {
        $mapping->id()->none();
    }

    public static function isSuperclass(): bool
    {
        return false;
    }
}
