<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Database;

use yjiotpukc\MongoODMFluent\Builder\Database\CollectionBuilder;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\BuilderTestCase;

class CollectionTest extends BuilderTestCase
{
    public function testCollection(): void
    {
        $builder = new CollectionBuilder('someName');
        $builder->build($this->metadata);

        static::assertSame('someName', $this->metadata->collection);
    }

    public function testCappedCollection(): void
    {
        $builder = new CollectionBuilder('someName');
        $builder->cappedAt(1000000);

        $builder->build($this->metadata);

        static::assertSame(1000000, $this->metadata->getCollectionSize());
    }

    public function testCappedCollectionWithMax(): void
    {
        $builder = new CollectionBuilder('someName');
        $builder->cappedAt(1000000, 1000);

        $builder->build($this->metadata);

        static::assertSame(1000, $this->metadata->getCollectionMax());
    }
}
