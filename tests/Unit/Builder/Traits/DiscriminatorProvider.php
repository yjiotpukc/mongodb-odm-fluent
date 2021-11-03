<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Traits;

use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\AnotherEntityStub;
use yjiotpukc\MongoODMFluent\Type\Discriminator;

trait DiscriminatorProvider
{
    public function discriminatorProvider(): array
    {
        return [
            [
                new Discriminator('type'),
                [
                    'defaultDiscriminatorValue' => null,
                    'discriminatorField' => 'type',
                    'discriminatorMap' => [],
                ],
            ],
            [
                (new Discriminator('type'))
                    ->map('physical', AnotherEntityStub::class)
                    ->default('physical'),
                [
                    'defaultDiscriminatorValue' => 'physical',
                    'discriminatorField' => 'type',
                    'discriminatorMap' => ['physical' => AnotherEntityStub::class],
                ],
            ],
            [
                (new Discriminator('type'))
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
