<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Mappings;

use yjiotpukc\MongoODMFluent\Builder\Document\MappedSuperclassBuilder;
use yjiotpukc\MongoODMFluent\Mapping\MappedSuperclassMapping;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\Bird;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\Dog;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\Pet;
use yjiotpukc\MongoODMFluent\Type\Discriminator;

class PetMapping extends MappedSuperclassMapping
{
    public function mapFor(): string
    {
        return Pet::class;
    }

    public function map(MappedSuperclassBuilder $builder): void
    {
        $builder->db('dbName');
        $builder->collection('pets');
        $builder->singleCollection();
        $builder->id();
        $builder->field('string', 'name');
        $discriminator = new Discriminator('type');
        $discriminator->map('dog', Dog::class)->map('bird', Bird::class);
        $builder->discriminator(new \yjiotpukc\MongoODMFluent\Builder\Database\Discriminator($discriminator));
    }
}
