<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Mappings;

use yjiotpukc\MongoODMFluent\Builder\EmbeddedDocument;

class ImageMetadataMapping implements \yjiotpukc\MongoODMFluent\Document\EmbeddedDocument
{
    public function map(EmbeddedDocument $builder): void
    {
        $builder->string('uploadedBy');
    }
}
