<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Mappings;

use yjiotpukc\MongoODMFluent\Builder\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\Dog;

class DogMapping extends DocumentMapping
{
    public function mapFor(): string
    {
        return Dog::class;
    }

    public function map(Document $builder): void
    {
        $builder->field('string', 'breed');
    }
}
