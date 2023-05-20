<?php

declare(strict_types=1);

namespace Examples\Entity;

use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\EmbedMany;
use Doctrine\ODM\MongoDB\Mapping\Annotations\EmbedOne;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use Examples\Collection\EmbeddedCollection;
use MongoDB\Collection;

/** @Document */
class Embeds
{
    /** @Id */
    private string $id;
    /**
     * @EmbedOne(targetDocument=Embedded::class)
     */
    private Embedded $ref1;
    /**
     * @EmbedOne(targetDocument=Embedded::class)
     */
    private Embedded $ref2;
    /**
     * @EmbedMany(targetDocument=Embedded::class)
     */
    private Collection $ref3;
    /**
     * @EmbedMany
     */
    private Collection $ref4;
    /**
     * @EmbedMany(discriminatorField="type")
     */
    private Collection $ref5;
    /**
     * @EmbedMany(
     *     discriminatorField="type",
     *     discriminatorMap={"emb"=Embedded::class},
     *     defaultDiscriminatorValue="emb"
     * )
     */
    private Collection $ref6;
    /**
     * @EmbedOne(
     *     targetDocument=Embedded::class,
     *     notSaved=true,
     *     nullable=true
     * )
     */
    private Embedded $ref7;
    /**
     * @EmbedMany(
     *     targetDocument=Embedded::class,
     *     collectionClass=EmbeddedCollection::class
     * )
     */
    private EmbeddedCollection $ref8;
    /**
     * @EmbedMany(
     *     targetDocument=Embedded::class,
     *     strategy="addToSet"
     * )
     */
    private Collection $ref9;
    /**
     * @EmbedMany(
     *     targetDocument=Embedded::class,
     *     strategy="set"
     * )
     */
    private Collection $ref10;
    /**
     * @EmbedMany(
     *     targetDocument=Embedded::class,
     *     strategy="setArray"
     * )
     */
    private Collection $ref11;
    /**
     * @EmbedMany(
     *     targetDocument=Embedded::class,
     *     strategy="pushAll"
     * )
     */
    private Collection $ref12;
    /**
     * @EmbedMany(
     *     targetDocument=Embedded::class,
     *     strategy="atomicSet"
     * )
     */
    private Collection $ref13;
    /**
     * @EmbedMany(
     *     targetDocument=Embedded::class,
     *     strategy="atomicSetArray"
     * )
     */
    private Collection $ref14;
}
