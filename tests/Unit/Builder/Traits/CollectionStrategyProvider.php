<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Traits;

use yjiotpukc\MongoODMFluent\Type\CollectionStrategy;

trait CollectionStrategyProvider
{
    public function collectionStrategyProvider(): array
    {
        return [
            [
                (new CollectionStrategy())->set(),
                ['strategy' => 'set'],
            ],
            [
                (new CollectionStrategy())->setArray(),
                ['strategy' => 'setArray'],
            ],
            [
                (new CollectionStrategy())->addToSet(),
                ['strategy' => 'addToSet'],
            ],
            [
                (new CollectionStrategy())->pushAll(),
                ['strategy' => 'pushAll'],
            ],
        ];
    }
}
