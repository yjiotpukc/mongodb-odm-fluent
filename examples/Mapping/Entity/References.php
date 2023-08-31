<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Examples\Mapping\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceMany;
use Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceOne;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;
use yjiotpukc\MongoODMFluent\Examples\Mapping\Collection\EntityCollection;
use yjiotpukc\MongoODMFluent\Examples\Mapping\Entity\References as ReferencesEntity;

/** @Document */
class References
{
    /** @Id */
    private string $id;
    /**
     * @ReferenceOne(targetDocument=References::class, inversedBy="children")
     */
    private References $parent;
    /**
     * @ReferenceMany(
     *     targetDocument=References::class,
     *     mappedBy="parent",
     *     prime={"ref1"})
     */
    private Collection $children;
    /**
     * @ReferenceOne(targetDocument=Entity::class)
     */
    private Entity $ref1;
    /**
     * @ReferenceOne(targetDocument=Entity::class)
     */
    private Entity $ref2;
    /**
     * @ReferenceMany(targetDocument=Entity::class)
     */
    private Entity $ref3;
    /**
     * @ReferenceMany
     */
    private Entity $ref4;
    /**
     * @ReferenceMany(discriminatorField="type")
     */
    private Entity $ref5;
    /**
     * @ReferenceMany(
     *     strategy="pushAll",
     *     discriminatorField="type",
     *     discriminatorMap={"ent"=Entity::class},
     *     defaultDiscriminatorValue="ent"
     * )
     */
    private Collection $ref6;
    /**
     * @ReferenceOne(
     *     targetDocument=Entity::class,
     *     notSaved=true,
     *     nullable=true,
     *     orphanRemoval=true
     * )
     */
    private Entity $ref7;
    /**
     * @ReferenceMany(
     *     targetDocument=Entity::class,
     *     collectionClass=EntityCollection::class,
     *     repositoryMethod="findEntities"
     * )
     */
    private EntityCollection $ref8;
    /**
     * @ReferenceMany(
     *     targetDocument=Entity::class,
     *     strategy="set",
     *     criteria={"field"="value"},
     *     sort={"sorting"="asc"},
     *     skip=5,
     *     limit=10
     * )
     */
    private Collection $ref9;
    /**
     * @ReferenceMany(
     *     targetDocument=Entity::class,
     *     storeAs="id",
     *     cascade="all",
     *     strategy="addToSet"
     * )
     */
    private Collection $ref10;
    /**
     * @ReferenceMany(
     *     targetDocument=Entity::class,
     *     storeAs="ref",
     *     cascade="remove",
     *     strategy="set"
     * )
     */
    private Collection $ref11;
    /**
     * @ReferenceMany(
     *     targetDocument=Entity::class,
     *     storeAs="dbRef",
     *     cascade="persist",
     *     strategy="setArray"
     * )
     */
    private Collection $ref12;
    /**
     * @ReferenceMany(
     *     targetDocument=Entity::class,
     *     storeAs="dbRefWithDb",
     *     cascade="refresh",
     *     strategy="pushAll"
     * )
     */
    private Collection $ref13;
    /**
     * @ReferenceMany(
     *     targetDocument=Entity::class,
     *     cascade="merge",
     *     strategy="atomicSet"
     * )
     */
    private Collection $ref14;
    /**
     * @ReferenceMany(
     *     targetDocument=Entity::class,
     *     cascade="detach",
     *     strategy="atomicSetArray"
     * )
     */
    private Collection $ref15;
    /**
     * @ReferenceMany(
     *     targetDocument=Entity::class,
     *     cascade={"remove", "persist"}
     * )
     */
    private Collection $ref16;

    public static function loadMetadata(ClassMetadata $classMetadata): void
    {
        $builder = new DocumentBuilder();
        $builder->id();

        $builder->referenceOne('parent', ReferencesEntity::class)
            ->inversedBy('children');
        $builder->referenceMany('children', ReferencesEntity::class)
            ->mappedBy('parent')
            ->addPrime('ref1');

        $builder->referenceOne('ref1', Entity::class);
        $builder->referenceOne('ref2')->target(Entity::class);

        $builder->referenceMany('ref3', Entity::class);
        $builder->referenceMany('ref4');
        $builder->referenceMany('ref5')->discriminator('type');
        $builder->referenceMany('ref6')
            ->discriminator('type')
            ->map('ent', Entity::class)
            ->default('ent');

        $builder->referenceOne('ref7', Entity::class)
            ->notSaved()
            ->nullable()
            ->orphanRemoval();
        $builder->referenceMany('ref8', Entity::class)
            ->collectionClass(EntityCollection::class)
            ->repositoryMethod('findEntities');

        $builder->referenceMany('ref9', Entity::class)
            ->addCriteria('field', 'value')
            ->addSort('sorting')
            ->skip(5)
            ->limit(10)
            ->strategy()->set();

        $ref = $builder->referenceMany('ref10', Entity::class)->storeAsId();
        $ref->cascade()->all();
        $ref->strategy()->addToSet();

        $ref = $builder->referenceMany('ref11', Entity::class)->storeAsRef();
        $ref->cascade()->remove();
        $ref->strategy()->set();

        $ref = $builder->referenceMany('ref12', Entity::class)->storeAsDbRef();
        $ref->cascade()->persist();
        $ref->strategy()->setArray();

        $ref = $builder->referenceMany('ref13', Entity::class)->storeAsDbRefWithDb();
        $ref->cascade()->refresh();
        $ref->strategy()->pushAll();

        $ref = $builder->referenceMany('ref14', Entity::class);
        $ref->cascade()->merge();
        $ref->strategy()->atomicSet();

        $ref = $builder->referenceMany('ref15', Entity::class);
        $ref->cascade()->detach();
        $ref->strategy()->atomicSetArray();

        $ref = $builder->referenceMany('ref16', Entity::class);
        $ref->cascade()->remove()->persist();

        $builder->build($classMetadata);
    }
}
