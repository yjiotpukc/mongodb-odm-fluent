<?php

declare(strict_types=1);

namespace Examples\Entity;

use Doctrine\ODM\MongoDB\Mapping\Annotations\AlsoLoad;
use Doctrine\ODM\MongoDB\Mapping\Annotations\ChangeTrackingPolicy;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Index;
use Doctrine\ODM\MongoDB\Mapping\Annotations\ReadPreference;
use Doctrine\ODM\MongoDB\Mapping\Annotations\ShardKey;

/**
 * @Document(
 *     readOnly=true,
 *     writeConcern="majority"
 * )
 * @ReadPreference("secondaryPreferred")
 * @ShardKey(keys={"shardKey"="asc"})
 */
class Misc
{
    /**
     * @Id()
     * @Index()
     */
    private string $id;
    /** @Field(type="string") */
    private string $shardKey;

    /** @AlsoLoad("field") */
    public function alsoLoad(string $field): void
    {
    }
}
