<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Type;

use PHPUnit\Framework\TestCase;
use yjiotpukc\MongoODMFluent\Builder\Field\CollectionStrategyPartial;

class CollectionStrategyTest extends TestCase
{
    public function testDefault()
    {
        $collectionStrategy = new CollectionStrategyPartial();

        self::assertSame(['strategy' => 'pushAll'], $collectionStrategy->toMapping());
    }

    public function testSet()
    {
        $collectionStrategy = new CollectionStrategyPartial();
        $collectionStrategy->set();

        self::assertSame(['strategy' => 'set'], $collectionStrategy->toMapping());
    }

    public function testPushAll()
    {
        $collectionStrategy = new CollectionStrategyPartial();
        $collectionStrategy->pushAll();

        self::assertSame(['strategy' => 'pushAll'], $collectionStrategy->toMapping());
    }

    public function testAddToSet()
    {
        $collectionStrategy = new CollectionStrategyPartial();
        $collectionStrategy->addToSet();

        self::assertSame(['strategy' => 'addToSet'], $collectionStrategy->toMapping());
    }

    public function testSetArray()
    {
        $collectionStrategy = new CollectionStrategyPartial();
        $collectionStrategy->setArray();

        self::assertSame(['strategy' => 'setArray'], $collectionStrategy->toMapping());
    }
}
