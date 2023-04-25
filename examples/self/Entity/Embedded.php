<?php

declare(strict_types=1);

namespace Examples\Entity;

use yjiotpukc\MongoODMFluent\Document\EmbeddedDocument;
use yjiotpukc\MongoODMFluent\Mapping\EmbeddedDocumentMapping;

class Embedded implements EmbeddedDocument
{
    private string $someString;

    public static function map(EmbeddedDocumentMapping $mapping): void
    {
        $mapping->field('string', 'someString');
    }
}
