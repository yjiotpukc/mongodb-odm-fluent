<?php

declare(strict_types=1);

namespace Examples\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\EmbedMany;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;

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
}
