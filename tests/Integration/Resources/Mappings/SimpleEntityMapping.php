<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Mappings;

use yjiotpukc\MongoODMFluent\Builder\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\SimpleEntity;

class SimpleEntityMapping extends DocumentMapping
{
    public function mapFor(): string
    {
        return SimpleEntity::class;
    }

    public function map(Document $builder): void
    {
        $builder->db('dbName');
        $builder->collection('simple');
        $builder->id();
        $builder->field('string', 'name');
    }
}
