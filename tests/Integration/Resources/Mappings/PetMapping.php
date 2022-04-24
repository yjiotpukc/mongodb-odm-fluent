<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Mappings;

use yjiotpukc\MongoODMFluent\Builder\Document;
use yjiotpukc\MongoODMFluent\Document\MappedSuperclass;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\Bird;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\Dog;

class PetMapping implements MappedSuperclass
{
    public function map(Document $builder): void
    {
        $builder = $builder->db('dbName');
        $builder->collection('pets');
        $builder->singleCollection();
        $builder->id();
        $builder->field('string', 'name');
        $builder->discriminator('type')->map('dog', Dog::class)->map('bird', Bird::class);
    }
}
