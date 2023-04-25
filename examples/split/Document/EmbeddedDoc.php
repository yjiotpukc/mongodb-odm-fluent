<?php

declare(strict_types=1);

namespace Examples\Document;

use yjiotpukc\MongoODMFluent\Document\EmbeddedDocument;
use yjiotpukc\MongoODMFluent\Mapping\EmbeddedDocumentMapping;

class EmbeddedDoc implements EmbeddedDocument
{
    public static function map(EmbeddedDocumentMapping $mapping): void
    {
        $mapping->field('string', 'someString');
    }
}
