<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Mappings;

use yjiotpukc\MongoODMFluent\Builder\Document;

class SimpleEntityMapping implements \yjiotpukc\MongoODMFluent\Document\Document
{
    public function map(Document $builder): void
    {
        $builder->db('dbName');
        $builder->collection('simple');
        $builder->id();
        $builder->field('string', 'name');
    }
}
