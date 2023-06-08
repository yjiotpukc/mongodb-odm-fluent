<?php

declare(strict_types=1);

namespace Examples\Document\Inheritance;

use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class HatikoDoc implements Document
{
    public static function map(DocumentMapping $mapping): void
    {
        $mapping->string('hatikoPrivate');
        $mapping->string('hatikoProtected');
        $mapping->string('hatikoPublic');
    }
}
