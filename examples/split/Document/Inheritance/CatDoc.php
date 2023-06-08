<?php

declare(strict_types=1);

namespace Examples\Document\Inheritance;

use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class CatDoc implements Document
{
    public static function map(DocumentMapping $mapping): void
    {
        $mapping->string('catPrivate');
        $mapping->string('catProtected');
        $mapping->string('catPublic');
    }
}
