<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Traits;

trait TestDb
{
    public function testDb()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->db('someName');
        $builder->build($metadata);

        static::assertSame('someName', $metadata->db);
    }
}
