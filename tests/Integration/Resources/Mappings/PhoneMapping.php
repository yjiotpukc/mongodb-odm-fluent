<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Mappings;

use yjiotpukc\MongoODMFluent\Document\EmbeddedDocument;
use yjiotpukc\MongoODMFluent\Mapping\EmbeddedDocumentMapping;

class PhoneMapping implements EmbeddedDocument
{
    public function map(EmbeddedDocumentMapping $mapping): void
    {
        $mapping->field('string', 'phoneNumber');
    }
}
