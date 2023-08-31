<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Examples\Mapping\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\EmbedMany;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;

/**
 * @Document(
 *     db="dbName",
 *     collection={
 *         "name"="entities",
 *         "capped"=true,
 *         "size"="100000",
 *         "max"="1000"
 *     }
 * )
 */
class Entity
{
    /** @Id */
    private string $id;
    /** @Field(type="string") */
    private string $stringField;
    /** @EmbedMany(targetDocument=Embedded::class) */
    private Collection $embeds;

    public static function loadMetadata(ClassMetadata $classMetadata): void
    {
        $builder = new DocumentBuilder();
        $builder->db('dbName');
        $builder->collection('entities')
            ->cappedAt(100000, 1000);
        $builder->id();
        $builder->field('string', 'stringField');
        $builder->embedMany('embeds', Embedded::class);
        $builder->build($classMetadata);
    }
}
