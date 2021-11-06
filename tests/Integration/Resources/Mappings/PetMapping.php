<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Mappings;

use yjiotpukc\MongoODMFluent\Builder\MappedSuperclass;
use yjiotpukc\MongoODMFluent\Mapping\MappedSuperclassMapping;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\Bird;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\Dog;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\Pet;

class PetMapping extends MappedSuperclassMapping
{
    public function mapFor(): string
    {
        return Pet::class;
    }

    public function map(MappedSuperclass $builder): void
    {
        $builder = $builder->db('dbName');
        $builder->collection('pets');
        $builder->singleCollection();
        $builder->id();
        $builder->field('string', 'name');
        $builder->discriminator('type')->map('dog', Dog::class)->map('bird', Bird::class);
    }
}