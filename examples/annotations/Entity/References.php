<?php

declare(strict_types=1);

namespace Examples\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceMany;
use Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceOne;
use Examples\Collection\EntityCollection;

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
}
