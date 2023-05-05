<?php

declare(strict_types=1);

namespace Examples\Entity;

use DateTime;
use DateTimeImmutable;
use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\EmbedMany;
use Doctrine\ODM\MongoDB\Mapping\Annotations\EmbedOne;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceMany;
use Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceOne;

/** @Document */
class AllFieldTypes
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
    /** @Field(type="raw") */
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
    /** @EmbedOne(targetDocument=Entity::class) */
    private Entity $embedOne;
    /** @EmbedMany(targetDocument=Entity::class) */
    private Collection $embedMany;
    /** @ReferenceOne(targetDocument=Entity::class) */
    private Entity $referenceOne;
    /** @ReferenceMany(targetDocument=Entity::class) */
    private Collection $referenceMany;
}
