<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Traits;

use yjiotpukc\MongoODMFluent\Builder\Database\DiscriminatorBuilder;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\AnotherEntityStub;

trait DiscriminatorProvider
{
    public function discriminatorProvider(): array
    {
        return [
            [
                new DiscriminatorBuilder('type'),
                [
                    'defaultDiscriminatorValue' => null,
                    'discriminatorField' => 'type',
                    'discriminatorMap' => [],
                ],
            ],
            [
                (new DiscriminatorBuilder('type'))
                    ->map('physical', AnotherEntityStub::class)
                    ->default('physical'),
                [
                    'defaultDiscriminatorValue' => 'physical',
                    'discriminatorField' => 'type',
                    'discriminatorMap' => ['physical' => AnotherEntityStub::class],
                ],
            ],
            [
                (new DiscriminatorBuilder('type'))
                    ->map('email', AnotherEntityStub::class)
                    ->map('physical', AnotherEntityStub::class),
                [
                    'defaultDiscriminatorValue' => null,
                    'discriminatorField' => 'type',
                    'discriminatorMap' => [
                        'email' => AnotherEntityStub::class,
                        'physical' => AnotherEntityStub::class,
                    ],
                ],
            ],
        ];
    }
}
