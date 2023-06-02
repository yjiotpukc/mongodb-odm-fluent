<?php

declare(strict_types=1);

namespace Examples\Entity;

use Examples\Collection\EmbeddedCollection;
use MongoDB\Collection;
use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class Embeds implements Document
{
    private string $id;
    private Embedded $ref1;
    private Embedded $ref2;
    private Collection $ref3;
    private Collection $ref4;
    private Collection $ref5;
    private Collection $ref6;
    private Embedded $ref7;
    private EmbeddedCollection $ref8;
    private Collection $ref9;
    private Collection $ref10;
    private Collection $ref11;
    private Collection $ref12;
    private Collection $ref13;
    private Collection $ref14;

    public static function map(DocumentMapping $mapping): void
    {
        $mapping->id();

        $mapping->embedOne('ref1', Embedded::class);
        $mapping->embedOne('ref2')->target(Embedded::class);

        $mapping->embedMany('ref3', Embedded::class);
        $mapping->embedMany('ref4');
        $mapping->embedMany('ref5')->discriminator('type');
        $mapping->embedMany('ref6')
            ->discriminator('type')
            ->map('emb', Embedded::class)
            ->default('emb');

        $mapping->embedOne('ref7', Embedded::class)
            ->notSaved()
            ->nullable();
        $mapping->embedMany('ref8', Embedded::class)
            ->collectionClass(EmbeddedCollection::class);

        $mapping->embedMany('ref9', Embedded::class)
            ->strategy()->addToSet();
        $mapping->embedMany('ref10', Embedded::class)
            ->strategy()->set();
        $mapping->embedMany('ref11', Embedded::class)
            ->strategy()->setArray();
        $mapping->embedMany('ref12', Embedded::class)
            ->strategy()->pushAll();
        $mapping->embedMany('ref13', Embedded::class)
            ->strategy()->atomicSet();
        $mapping->embedMany('ref14', Embedded::class)
            ->strategy()->atomicSetArray();
    }

    public static function isSuperclass(): bool
    {
        return false;
    }
}
