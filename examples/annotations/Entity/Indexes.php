<?php

declare(strict_types=1);

namespace Examples\Entity;

use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\EmbedOne;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Index;

/**
 * @Document
 * @Index(keys={"field3"="asc", "field2"="asc"})
 * @Index(keys={"field2"="asc", "field3"="desc"})
 */
class Indexes
{
    /** @Id */
    private string $id;
    /**
     * @Field(type="string")
     * @Index
     * @Index(order="desc")
     */
    private string $field1;
    /** @Field(type="string") */
    private string $field2;
    /** @Field(type="string") */
    private string $field3;
    /**
     * @Field(type="string")
     * @Index(
     *     name="field4Index",
     *     unique=true,
     *     sparse=true,
     *     background=true,
     *     expireAfterSeconds=120,
     *     partialFilterExpression={"field2"={"$eq"="someVal"}}
     * )
     */
    private string $field4;
    /**
     * @Field(type="string")
     * @Index(keys={"field5"="text"})
     */
    private string $field5;
    /**
     * @EmbedOne(targetDocument=Embedded::class)
     * @Index(keys={"coordinates"="2d"})
     */
    private Embedded $coordinates;
}
