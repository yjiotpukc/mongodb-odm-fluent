<?php

declare(strict_types=1);

namespace Examples\Document\Inheritance;

use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class PomeranianDoc implements Document
{
    public static function map(DocumentMapping $mapping): void
    {
        $mapping->string('pomeranianPrivate');
        $mapping->string('pomeranianProtected');
        $mapping->string('pomeranianPublic');
    }

    public static function isSuperclass(): bool
    {
        return false;
    }
}
