<?php

declare(strict_types=1);

namespace Examples\Document;

use Examples\Entity\Embedded;
use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class IndexesDoc implements Document
{
    public static function map(DocumentMapping $mapping): void
    {
        $mapping->id();
        $mapping->string('field1');
        $mapping->string('field2');
        $mapping->string('field3');
        $mapping->string('field4');
        $mapping->string('field5');
        $mapping->embedOne('coordinates', Embedded::class);

        $mapping->index(['field3', 'field2']);
        $mapping->index()
            ->asc('field2')
            ->desc('field3');
        $mapping->index('field1');
        $mapping->index('field1')->desc();
        $mapping->index('field4')
            ->name('field4Index')
            ->unique()
            ->sparse()
            ->background()
            ->expireAfter(120)
            ->partialFilter(['field2' => ['$eq' => 'someVal']]);
        $mapping->index('field5')->text();
        $mapping->index('coordinates')->geo();
    }

    public static function isSuperclass(): bool
    {
        return false;
    }
}
