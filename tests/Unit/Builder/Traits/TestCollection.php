<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Traits;

trait TestCollection
{
    public function testCollection()
    {
        $this->builder->collection('someName');
        $this->builder->build($this->metadata);

        static::assertSame('someName', $this->metadata->collection);
    }
}
