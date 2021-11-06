<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Mappings;

use yjiotpukc\MongoODMFluent\Builder\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\Bird;

class BirdMapping extends DocumentMapping
{
    public function mapFor(): string
    {
        return Bird::class;
    }

    public function map(Document $builder): void
    {
        $builder->field('boolean', 'isTalking');
    }
}
