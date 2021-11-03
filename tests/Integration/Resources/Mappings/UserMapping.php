<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Mappings;

use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\Phone;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\User;

class UserMapping extends DocumentMapping
{
    public function mapFor(): string
    {
        return User::class;
    }

    public function map(DocumentBuilder $builder): void
    {
        $builder->db('dbName');
        $builder->collection('users');
        $builder->id();
        $builder->field('string', 'name');
        $builder->embedMany('phones', Phone::class);
    }
}
