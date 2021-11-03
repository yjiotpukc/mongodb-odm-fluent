<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Database;

use yjiotpukc\MongoODMFluent\Builder\Database\Db;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\BuilderBaseTestCase;

class DbTest extends BuilderBaseTestCase
{
    public function testDb()
    {
        $this->builder = new Db('someName');
        $this->builder->build($this->metadata);

        static::assertSame('someName', $this->metadata->db);
    }
}
