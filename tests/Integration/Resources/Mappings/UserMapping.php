<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Mappings;

use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\Phone;

class UserMapping implements Document
{
    public function map(DocumentMapping $builder): void
    {
        $builder->db('dbName');
        $builder->collection('users');
        $builder->id();
        $builder->field('string', 'name');
        $builder->embedMany('phones', Phone::class);
    }
}
