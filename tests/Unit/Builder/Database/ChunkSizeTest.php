<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Database;

use yjiotpukc\MongoODMFluent\Builder\Database\ChunkSizeBuilder;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\BuilderTestCase;

class ChunkSizeTest extends BuilderTestCase
{
    public function testChunkSize(): void
    {
        $builder = new ChunkSizeBuilder(100000);
        $builder->build($this->metadata);

        static::assertSame(100000, $this->metadata->getChunkSizeBytes());
    }
}
