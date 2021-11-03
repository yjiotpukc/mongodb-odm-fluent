<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Mappings;

use yjiotpukc\MongoODMFluent\Builder\Document\EmbeddedDocumentBuilder;
use yjiotpukc\MongoODMFluent\Mapping\EmbeddedDocumentMapping;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\Phone;

class PhoneMapping extends EmbeddedDocumentMapping
{
    public function mapFor(): string
    {
        return Phone::class;
    }

    public function map(EmbeddedDocumentBuilder $builder): void
    {
        $builder->field('string', 'phoneNumber');
    }
}
