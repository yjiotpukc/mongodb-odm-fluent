<?php

declare(strict_types=1);

namespace Examples\Entity;

use yjiotpukc\MongoODMFluent\Document\EmbeddedDocument;
use yjiotpukc\MongoODMFluent\Mapping\EmbeddedDocumentMapping;

class Embedded implements EmbeddedDocument
{
    private float $latitude;
    private float $longitude;

    public static function map(EmbeddedDocumentMapping $mapping): void
    {
        $mapping->float('latitude');
        $mapping->float('longitude');
    }
}
