<?php

declare(strict_types=1);

namespace Examples\Document\Inheritance;

use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class DogDoc implements Document
{
    public static function map(DocumentMapping $mapping): void
    {
        $mapping->string('dogPrivate');
        $mapping->string('dogProtected');
        $mapping->string('dogPublic');
    }
}
