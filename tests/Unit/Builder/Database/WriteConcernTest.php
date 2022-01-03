<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Database;

use yjiotpukc\MongoODMFluent\Builder\Database\WriteConcernBuilder;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\BuilderTestCase;

class WriteConcernTest extends BuilderTestCase
{
    public function testNullWriteConcern(): void
    {
        $builder = new WriteConcernBuilder(null);
        $builder->build($this->metadata);

        self::assertNull($this->metadata->getWriteConcern());
    }

    public function testStringWriteConcern(): void
    {
        $builder = new WriteConcernBuilder('some');
        $builder->build($this->metadata);

        self::assertSame('some', $this->metadata->getWriteConcern());
    }

    public function testIntegerWriteConcern(): void
    {
        $builder = new WriteConcernBuilder(4);
        $builder->build($this->metadata);

        self::assertSame(4, $this->metadata->getWriteConcern());
    }
}
