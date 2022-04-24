<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Mappings;

use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class BirdMapping implements Document
{
    public function map(DocumentMapping $builder): void
    {
        $builder->field('boolean', 'isTalking');
    }
}
