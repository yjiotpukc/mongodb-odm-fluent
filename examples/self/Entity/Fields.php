<?php

declare(strict_types=1);

namespace Examples\Entity;

use DateTime;
use DateTimeImmutable;
use Doctrine\Common\Collections\Collection;
use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class Fields implements Document
{
    private string $id;
    private string $fieldField;
    private string $stringField;
    private int $intField;
    private float $floatField;
    private bool $boolField;
    private string $timestampField;
    private DateTime $dateField;
    private DateTimeImmutable $dateImmutableField;
    private string $decimalField;
    private array $arrayField;
    private array $hashField;
    private string $keyField;
    private string $objectIdField;
    private $rawField;
    private string $binField;
    private string $binBytearrayField;
    private string $binCustomField;
    private string $binFuncField;
    private string $binMd5Field;
    private string $binUuidField;
    private int $optionsField;
    private Entity $embedOne;
    private Collection $embedMany;
    private Entity $referenceOne;
    private Collection $referenceMany;

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

    public static function isSuperclass(): bool
    {
        return false;
    }
}
