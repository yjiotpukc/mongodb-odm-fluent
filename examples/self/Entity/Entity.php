<?php

declare(strict_types=1);

namespace Examples\Entity;

use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class Entity implements Document
{
    private string $id;
    private string $stringField;
    /** @var Embedded[] */
    private array $embeds;

    public static function map(DocumentMapping $mapping): void
    {
        $mapping->db('dbName');
        $mapping->collection('entities')
            ->cappedAt(100000, 1000);
        $mapping->id();
        $mapping->field('string', 'stringField');
        $mapping->embedMany('embeds', Embedded::class);
    }
}
