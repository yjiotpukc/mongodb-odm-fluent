<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Examples\Mapping\Entity;

use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\EmbedMany;
use Doctrine\ODM\MongoDB\Mapping\Annotations\EmbedOne;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;
use yjiotpukc\MongoODMFluent\Examples\Mapping\Collection\EmbeddedCollection;
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

    public static function loadMetadata(ClassMetadata $classMetadata): void
    {
        $builder = new DocumentBuilder();
        $builder->id();

        $builder->embedOne('ref1', Embedded::class);
        $builder->embedOne('ref2')->target(Embedded::class);

        $builder->embedMany('ref3', Embedded::class);
        $builder->embedMany('ref4');
        $builder->embedMany('ref5')->discriminator('type');
        $builder->embedMany('ref6')
            ->discriminator('type')
            ->map('emb', Embedded::class)
            ->default('emb');

        $builder->embedOne('ref7', Embedded::class)
            ->notSaved()
            ->nullable();
        $builder->embedMany('ref8', Embedded::class)
            ->collectionClass(EmbeddedCollection::class);

        $builder->embedMany('ref9', Embedded::class)
            ->strategy()->addToSet();
        $builder->embedMany('ref10', Embedded::class)
            ->strategy()->set();
        $builder->embedMany('ref11', Embedded::class)
            ->strategy()->setArray();
        $builder->embedMany('ref12', Embedded::class)
            ->strategy()->pushAll();
        $builder->embedMany('ref13', Embedded::class)
            ->strategy()->atomicSet();
        $builder->embedMany('ref14', Embedded::class)
            ->strategy()->atomicSetArray();

        $builder->build($classMetadata);
    }
}
