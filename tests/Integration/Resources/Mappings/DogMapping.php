<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Mappings;

use yjiotpukc\MongoODMFluent\Builder\Document;

class DogMapping implements \yjiotpukc\MongoODMFluent\Document\Document
{
    public function map(Document $builder): void
    {
        $builder->field('string', 'breed');
    }
}
