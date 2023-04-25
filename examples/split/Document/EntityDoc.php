<?php

declare(strict_types=1);

namespace Examples\Document;

use Examples\Entity\Embedded;
use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class EntityDoc implements Document
{
    public static function map(DocumentMapping $mapping): void
    {
        $mapping->db('dbName');
        $mapping->collection('entities');
        $mapping->id();
        $mapping->field('string', 'stringField');
        $mapping->embedMany('embeds', Embedded::class);
    }

    public static function isSuperclass(): bool
    {
        return false;
    }
}
