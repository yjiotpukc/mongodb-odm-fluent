<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Examples\Mapping\Entity;

use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use Doctrine\ODM\MongoDB\Mapping\Annotations\ShardKey;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;

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

    public static function loadMetadata(ClassMetadata $classMetadata): void
    {
        $builder = new DocumentBuilder();
        $builder->id();
        $builder->string('shardKey1');
        $builder->string('shardKey2');
        $builder->shard()
            ->asc('shardKey1')
            ->desc('shardKey2')
            ->unique()
            ->numInitialChunks(10);
        $builder->build($classMetadata);
    }
}
