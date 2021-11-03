<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Traits;

trait TestDb
{
    public function testDb()
    {
        $this->builder->db('someName');
        $this->builder->build($this->metadata);

        static::assertSame('someName', $this->metadata->db);
    }
}
