<?php

declare(strict_types=1);

namespace Examples\Document;

use Examples\Collection\EntityCollection;
use Examples\Entity\Entity;
use Examples\Entity\References;
use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class ReferencesDoc implements Document
{
    public static function map(DocumentMapping $mapping): void
    {
        $mapping->id();

        $mapping->referenceOne('parent', References::class)
            ->inversedBy('children');
        $mapping->referenceMany('children', References::class)
            ->mappedBy('parent')
            ->addPrime('ref1');

        $mapping->referenceOne('ref1', Entity::class);
        $mapping->referenceOne('ref2')->target(Entity::class);

        $mapping->referenceMany('ref3', Entity::class);
        $mapping->referenceMany('ref4');
        $mapping->referenceMany('ref5')->discriminator('type');
        $mapping->referenceMany('ref6')
            ->discriminator('type')
            ->map('ent', Entity::class)
            ->default('ent');

        $mapping->referenceOne('ref7', Entity::class)
            ->notSaved()
            ->nullable()
            ->orphanRemoval();
        $mapping->referenceMany('ref8', Entity::class)
            ->collectionClass(EntityCollection::class)
            ->repositoryMethod('findEntities');

        $mapping->referenceMany('ref9', Entity::class)
            ->addCriteria('field', 'value')
            ->addSort('sorting')
            ->skip(5)
            ->limit(10)
            ->strategy()->set();

        $ref = $mapping->referenceMany('ref10', Entity::class)->storeAsId();
        $ref->cascade()->all();
        $ref->strategy()->addToSet();

        $ref = $mapping->referenceMany('ref11', Entity::class)->storeAsRef();
        $ref->cascade()->remove();
        $ref->strategy()->set();

        $ref = $mapping->referenceMany('ref12', Entity::class)->storeAsDbRef();
        $ref->cascade()->persist();
        $ref->strategy()->setArray();

        $ref = $mapping->referenceMany('ref13', Entity::class)->storeAsDbRefWithDb();
        $ref->cascade()->refresh();
        $ref->strategy()->pushAll();

        $ref = $mapping->referenceMany('ref14', Entity::class);
        $ref->cascade()->merge();
        $ref->strategy()->atomicSet();

        $ref = $mapping->referenceMany('ref15', Entity::class);
        $ref->cascade()->detach();
        $ref->strategy()->atomicSetArray();

        $ref = $mapping->referenceMany('ref16', Entity::class);
        $ref->cascade()->remove()->persist();
    }

    public static function isSuperclass(): bool
    {
        return false;
    }
}
