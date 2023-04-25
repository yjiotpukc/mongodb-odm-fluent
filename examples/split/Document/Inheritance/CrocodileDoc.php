<?php

declare(strict_types=1);

namespace Examples\Document\Inheritance;

use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class CrocodileDoc implements Document
{
    public static function map(DocumentMapping $mapping): void
    {
        $mapping->id();
        $mapping->string('crocodilePrivate');
        $mapping->string('crocodileProtected');
        $mapping->string('crocodilePublic');
    }

    public static function isSuperclass(): bool
    {
        return false;
    }
}
