<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Type;

use PHPUnit\Framework\TestCase;
use yjiotpukc\MongoODMFluent\Type\CollectionStrategy;

class CollectionStrategyTest extends TestCase
{
    public function testSet()
    {
        $collectionStrategy = (new CollectionStrategy())->set();

        self::assertSame('set', $collectionStrategy->strategy);
    }
    public function testPushAll()
    {
        $collectionStrategy = (new CollectionStrategy())->pushAll();

        self::assertSame('pushAll', $collectionStrategy->strategy);
    }
    public function testAddToSet()
    {
        $collectionStrategy = (new CollectionStrategy())->addToSet();

        self::assertSame('addToSet', $collectionStrategy->strategy);
    }
    public function testSetArray()
    {
        $collectionStrategy = (new CollectionStrategy())->setArray();

        self::assertSame('setArray', $collectionStrategy->strategy);
    }
}
