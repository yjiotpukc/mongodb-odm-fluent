<?php

declare(strict_types=1);

namespace Examples\Document;

use Examples\Entity\Entity;
use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class FieldsDoc implements Document
{
    public static function map(DocumentMapping $mapping): void
    {
        $mapping->id();
        $mapping->field('string', 'fieldField');
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

        $mapping->int('optionsField')
            ->nameInDb('someField')
            ->nullable()
            ->increment()
            ->version()
            ->lock()
            ->alsoLoad('oldName');

        $mapping->embedOne('embedOne', Entity::class);
        $mapping->embedMany('embedMany', Entity::class);
        $mapping->referenceOne('referenceOne', Entity::class);
        $mapping->referenceMany('referenceMany', Entity::class);
    }
}
