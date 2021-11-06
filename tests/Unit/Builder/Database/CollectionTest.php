<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Database;

use yjiotpukc\MongoODMFluent\Builder\Database\CollectionBuilder;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\BuilderTestCase;

class CollectionTest extends BuilderTestCase
{
    public function testCollection()
    {
        $this->builder = new CollectionBuilder('someName');
        $this->builder->build($this->metadata);

        static::assertSame('someName', $this->metadata->collection);
    }
}
