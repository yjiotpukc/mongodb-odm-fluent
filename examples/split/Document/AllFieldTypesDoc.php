<?php

declare(strict_types=1);

namespace Examples\Document;

use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class AllFieldTypesDoc implements Document
{
    public static function map(DocumentMapping $mapping): void
    {
        $mapping->id();
        $mapping->string('stringField');
        $mapping->int('intField');
        $mapping->float('floatField');
        $mapping->bool('boolField');
        $mapping->timestamp('timestampField');
        $mapping->date('dateField');
        $mapping->dateImmutable('dateImmutableField');
        $mapping->decimal('decimalField');
        $mapping->array('arrayField');
        $mapping->hash('hashField');
        $mapping->key('keyField');
        $mapping->objectId('objectIdField');
        $mapping->raw('rawField');
        $mapping->bin('binField');
        $mapping->binBytearray('binBytearrayField');
        $mapping->binCustom('binCustomField');
        $mapping->binFunc('binFuncField');
        $mapping->binMd5('binMd5Field');
        $mapping->binUuid('binUuidField');
    }

    public static function isSuperclass(): bool
    {
        return false;
    }
}
