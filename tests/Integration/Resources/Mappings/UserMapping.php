<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Mappings;

use yjiotpukc\MongoODMFluent\Builder\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\Phone;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\User;

class UserMapping extends DocumentMapping
{
    public function map(Document $builder): void
    {
        $builder->db('dbName');
        $builder->collection('users');
        $builder->id();
        $builder->field('string', 'name');
        $builder->embedMany('phones', Phone::class);
    }
}
