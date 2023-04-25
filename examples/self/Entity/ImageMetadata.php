<?php

declare(strict_types=1);

namespace Examples\Entity;

use yjiotpukc\MongoODMFluent\Document\EmbeddedDocument;
use yjiotpukc\MongoODMFluent\Mapping\EmbeddedDocumentMapping;

class ImageMetadata implements EmbeddedDocument
{
    protected string $uploadedBy;

    public static function map(EmbeddedDocumentMapping $mapping): void
    {
        $mapping->string('uploadedBy');
    }
}
