<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Database;

use yjiotpukc\MongoODMFluent\Builder\Database\WriteConcernBuilder;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\BuilderTestCase;

class WriteConcernTest extends BuilderTestCase
{
    public function testNullWriteConcern()
    {
        $this->builder = new WriteConcernBuilder(null);
        $this->builder->build($this->metadata);

        self::assertNull($this->metadata->getWriteConcern());
    }

    public function testStringWriteConcern()
    {
        $this->builder = new WriteConcernBuilder('some');
        $this->builder->build($this->metadata);

        self::assertSame('some', $this->metadata->getWriteConcern());
    }

    public function testIntegerWriteConcern()
    {
        $this->builder = new WriteConcernBuilder(4);
        $this->builder->build($this->metadata);

        self::assertSame(4, $this->metadata->getWriteConcern());
    }
}
