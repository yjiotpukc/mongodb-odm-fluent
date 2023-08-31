<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Examples\Mapping\Entity;

use DateTime;
use DateTimeImmutable;
use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations\AlsoLoad;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\EmbedMany;
use Doctrine\ODM\MongoDB\Mapping\Annotations\EmbedOne;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Lock;
use Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceMany;
use Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceOne;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Version;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;

/** @Document */
class Fields
{
    /** @Id */
    private string $id;
    /** @Field(type="string") */
    private string $fieldField;
    /** @Field(type="string") */
    private string $stringField;
    /** @Field(type="int") */
    private int $intField;
    /** @Field(type="float") */
    private float $floatField;
    /** @Field(type="bool") */
    private bool $boolField;
    /** @Field(type="timestamp") */
    private string $timestampField;
    /** @Field(type="date") */
    private DateTime $dateField;
    /** @Field(type="date_immutable") */
    private DateTimeImmutable $dateImmutableField;
    /** @Field(type="decimal128") */
    private string $decimalField;
    /** @Field(type="collection") */
    private array $arrayField;
    /** @Field(type="hash") */
    private array $hashField;
    /** @Field(type="key") */
    private string $keyField;
    /** @Field(type="object_id") */
    private string $objectIdField;
    /**
     * @Field(type="raw")
     * @var mixed
     */
    private $rawField;
    /** @Field(type="bin") */
    private string $binField;
    /** @Field(type="bin_bytearray") */
    private string $binBytearrayField;
    /** @Field(type="bin_custom") */
    private string $binCustomField;
    /** @Field(type="bin_func") */
    private string $binFuncField;
    /** @Field(type="bin_md5") */
    private string $binMd5Field;
    /** @Field(type="bin_uuid") */
    private string $binUuidField;
    /**
     * @Field(
     *     type="int",
     *     name="someField",
     *     nullable=true,
     *     strategy="increment"
     * )
     * @Version
     * @Lock
     * @AlsoLoad("oldName")
     */
    private int $optionsField;
    /** @EmbedOne(targetDocument=Entity::class) */
    private Entity $embedOne;
    /** @EmbedMany(targetDocument=Entity::class) */
    private Collection $embedMany;
    /** @ReferenceOne(targetDocument=Entity::class) */
    private Entity $referenceOne;
    /** @ReferenceMany(targetDocument=Entity::class) */
    private Collection $referenceMany;

    public static function loadMetadata(ClassMetadata $classMetadata): void
    {
        $builder = new DocumentBuilder();
        $builder->id();
        $builder->field('string', 'fieldField');
        $builder->string('stringField');
        $builder->int('intField');
        $builder->float('floatField');
        $builder->bool('boolField');
        $builder->timestamp('timestampField');
        $builder->date('dateField');
        $builder->dateImmutable('dateImmutableField');
        $builder->decimal('decimalField');
        $builder->array('arrayField');
        $builder->hash('hashField');
        $builder->key('keyField');
        $builder->objectId('objectIdField');
        $builder->raw('rawField');
        $builder->bin('binField');
        $builder->binBytearray('binBytearrayField');
        $builder->binCustom('binCustomField');
        $builder->binFunc('binFuncField');
        $builder->binMd5('binMd5Field');
        $builder->binUuid('binUuidField');

        $builder->int('optionsField')
            ->nameInDb('someField')
            ->nullable()
            ->increment()
            ->version()
            ->lock()
            ->alsoLoad('oldName');

        $builder->embedOne('embedOne', Entity::class);
        $builder->embedMany('embedMany', Entity::class);
        $builder->referenceOne('referenceOne', Entity::class);
        $builder->referenceMany('referenceMany', Entity::class);

        $builder->build($classMetadata);
    }
}