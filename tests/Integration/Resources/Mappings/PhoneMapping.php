<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Mappings;

use yjiotpukc\MongoODMFluent\Builder\EmbeddedDocument;

class PhoneMapping implements \yjiotpukc\MongoODMFluent\Document\EmbeddedDocument
{
    public function map(EmbeddedDocument $builder): void
    {
        $builder->field('string', 'phoneNumber');
    }
}
