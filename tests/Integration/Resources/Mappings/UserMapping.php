<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Mappings;

use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\Phone;

class UserMapping implements Document
{
    public function map(DocumentMapping $mapping): void
    {
        $mapping->db('dbName');
        $mapping->collection('users');
        $mapping->id();
        $mapping->field('string', 'name');
        $mapping->embedMany('phones', Phone::class);
    }
}
