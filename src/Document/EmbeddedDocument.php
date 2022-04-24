<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Document;

use yjiotpukc\MongoODMFluent\Mapping\EmbeddedDocumentMapping;
use yjiotpukc\MongoODMFluent\Mapping\Mapping;

interface EmbeddedDocument extends Mapping
{
    public function map(EmbeddedDocumentMapping $mapping): void;
}
