<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Mappings;

use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class SimpleEntityMapping implements Document
{
    public function map(DocumentMapping $builder): void
    {
        $builder->db('dbName');
        $builder->collection('simple');
        $builder->id();
        $builder->field('string', 'name');
    }
}
