<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Database;

use yjiotpukc\MongoODMFluent\Builder\Database\DbBuilder;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\BuilderTestCase;

class DbTest extends BuilderTestCase
{
    public function testDb()
    {
        $this->builder = new DbBuilder('someName');
        $this->builder->build($this->metadata);

        static::assertSame('someName', $this->metadata->db);
    }
}
