<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Traits;

use yjiotpukc\MongoODMFluent\Type\Cascade;

trait CascadeProvider
{
    public function cascadeProvider(): array
    {
        return [
            [
                (new Cascade())->all(),
                [
                    'cascade' => [
                        'detach',
                        'merge',
                        'refresh',
                        'remove',
                        'persist',
                    ],
                    'isCascadeDetach' => true,
                    'isCascadeMerge' => true,
                    'isCascadePersist' => true,
                    'isCascadeRefresh' => true,
                    'isCascadeRemove' => true,
                ],
            ],
            [
                (new Cascade())->detach(),
                [
                    'cascade' => ['detach'],
                    'isCascadeDetach' => true,
                ],
            ],
            [
                (new Cascade())->merge(),
                [
                    'cascade' => ['merge'],
                    'isCascadeMerge' => true,
                ],
            ],
            [
                (new Cascade())->persist(),
                [
                    'cascade' => ['persist'],
                    'isCascadePersist' => true,
                ],
            ],
            [
                (new Cascade())->refresh(),
                [
                    'cascade' => ['refresh'],
                    'isCascadeRefresh' => true,
                ],
            ],
            [
                (new Cascade())->remove(),
                [
                    'cascade' => ['remove'],
                    'isCascadeRemove' => true,
                ],
            ],
        ];
    }
}
