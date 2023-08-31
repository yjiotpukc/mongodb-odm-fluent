<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Examples\Mapping\Entity;

use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\EmbedOne;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Index;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;

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

    public static function loadMetadata(ClassMetadata $classMetadata): void
    {
        $builder = new DocumentBuilder();
        $builder->id();
        $builder->string('field1');
        $builder->string('field2');
        $builder->string('field3');
        $builder->string('field4');
        $builder->string('field5');
        $builder->embedOne('coordinates', Embedded::class);

        $builder->index(['field3', 'field2']);
        $builder->index()
            ->asc('field2')
            ->desc('field3');
        $builder->index('field1');
        $builder->index('field1')->desc();
        $builder->index('field4')
            ->name('field4Index')
            ->unique()
            ->sparse()
            ->background()
            ->expireAfter(120)
            ->partialFilter(['field2' => ['$eq' => 'someVal']]);
        $builder->index('field5')->text();
        $builder->index('coordinates')->geo();
        $builder->build($classMetadata);
    }
}
