<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Mappings;

use yjiotpukc\MongoODMFluent\Builder\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class BirdMapping extends DocumentMapping
{
    public function map(Document $builder): void
    {
        $builder->field('boolean', 'isTalking');
    }
}
