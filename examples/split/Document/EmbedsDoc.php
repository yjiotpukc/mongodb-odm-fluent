<?php

declare(strict_types=1);

namespace Examples\Document;

use Examples\Collection\EmbeddedCollection;
use Examples\Entity\Embedded;
use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class EmbedsDoc implements Document
{
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
}
