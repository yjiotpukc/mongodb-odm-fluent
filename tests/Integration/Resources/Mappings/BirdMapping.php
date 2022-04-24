<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Mappings;

use yjiotpukc\MongoODMFluent\Builder\Document;

class BirdMapping implements \yjiotpukc\MongoODMFluent\Document\Document
{
    public function map(Document $builder): void
    {
        $builder->field('boolean', 'isTalking');
    }
}
