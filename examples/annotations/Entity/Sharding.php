<?php

declare(strict_types=1);

namespace Examples\Entity;

use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use Doctrine\ODM\MongoDB\Mapping\Annotations\ShardKey;

/**
 * @Document
 * @ShardKey(keys={"shardKey1"="asc", "shardKey2"="desc"}, unique=true, numInitialChunks=10)
 */
class Sharding
{
    /** @Id */
    private string $id;
    /** @Field(type="string") */
    private string $shardKey1;
    /** @Field(type="string") */
    private string $shardKey2;
}
