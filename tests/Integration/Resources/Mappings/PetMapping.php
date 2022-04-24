<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Mappings;

use yjiotpukc\MongoODMFluent\Document\MappedSuperclass;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\Bird;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\Dog;

class PetMapping implements MappedSuperclass
{
    public function map(DocumentMapping $mapping): void
    {
        $mapping = $mapping->db('dbName');
        $mapping->collection('pets');
        $mapping->singleCollection();
        $mapping->id();
        $mapping->field('string', 'name');
        $mapping->discriminator('type')->map('dog', Dog::class)->map('bird', Bird::class);
    }
}
