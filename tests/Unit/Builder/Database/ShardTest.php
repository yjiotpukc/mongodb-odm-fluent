<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Database;

use yjiotpukc\MongoODMFluent\Builder\Database\ShardBuilder;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\BuilderTestCase;

class ShardTest extends BuilderTestCase
{
    public function testShard(): void
    {
        $shard = $this->givenBuilder();

        $shard->build($this->metadata);

        self::assertSame([
            'keys' => ['year' => 1],
            'options' => [],
        ], $this->metadata->getShardKey());
    }

    public function testShardWithMultipleKeys(): void
    {
        $shard = $this->givenBuilder();
        $shard->desc('username');

        $shard->build($this->metadata);

        self::assertSame([
            'keys' => [
                'year' => 1,
                'username' => -1,
            ],
            'options' => [],
        ], $this->metadata->getShardKey());
    }

    public function testUniqueShard(): void
    {
        $shard = $this->givenBuilder();
        $shard->unique();

        $shard->build($this->metadata);

        self::assertSame([
            'keys' => ['year' => 1],
            'options' => ['unique' => true],
        ], $this->metadata->getShardKey());
    }

    public function testShardWithInitialChunks(): void
    {
        $shard = $this->givenBuilder();
        $shard->numInitialChunks(4);

        $shard->build($this->metadata);

        self::assertSame([
            'keys' => ['year' => 1],
            'options' => ['numInitialChunks' => 4],
        ], $this->metadata->getShardKey());
    }

    protected function givenBuilder(): ShardBuilder
    {
        $shard = new ShardBuilder();
        $shard->asc('year');

        return $shard;
    }
}
