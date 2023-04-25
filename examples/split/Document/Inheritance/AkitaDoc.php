<?php

declare(strict_types=1);

namespace Examples\Document\Inheritance;

use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class AkitaDoc implements Document
{
    public static function map(DocumentMapping $mapping): void
    {
        $mapping->string('akitaPrivate');
        $mapping->string('akitaProtected');
        $mapping->string('akitaPublic');
    }

    public static function isSuperclass(): bool
    {
        return false;
    }
}
