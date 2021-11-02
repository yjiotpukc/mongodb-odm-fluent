<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use PHPUnit\Framework\TestCase;
use yjiotpukc\MongoODMFluent\Tests\Stubs\EntityStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\AnotherEntityStub;
use yjiotpukc\MongoODMFluent\Type\Cascade;
use yjiotpukc\MongoODMFluent\Type\CollectionStrategy;
use yjiotpukc\MongoODMFluent\Type\Discriminator;

abstract class BuilderBaseTestCase extends TestCase
{
    abstract public function givenEmptyBuilder();

    public function givenBuilderWithId()
    {
        $builder = $this->givenEmptyBuilder();
        $builder->id();

        return $builder;
    }

    public function givenBuilderWithSomeFields()
    {
        $builder = $this->givenEmptyBuilder();
        $builder->field('string', 'firstName');
        $builder->field('string', 'lastName');
        $builder->field('int', 'age');

        return $builder;
    }

    public function givenClassMetadata(): ClassMetadata
    {
        return new ClassMetadata(EntityStub::class);
    }

    protected function assertFieldMappingIsCorrect(array $defaultFields, array $overwriteFields, array $fieldMapping, array $deleteFields = [])
    {
        $expectedFields = array_merge($defaultFields, $overwriteFields);
        foreach ($deleteFields as $deleteField) {
            unset($expectedFields[$deleteField]);
        }

        ksort($expectedFields);
        ksort($fieldMapping);

        static::assertSame($expectedFields, $fieldMapping);
    }

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
                    'cascade' => [
                        'detach',
                    ],
                    'isCascadeDetach' => true,
                ],
            ],
            [
                (new Cascade())->merge(),
                [
                    'cascade' => [
                        'merge',
                    ],
                    'isCascadeMerge' => true,
                ],
            ],
            [
                (new Cascade())->persist(),
                [
                    'cascade' => [
                        'persist',
                    ],
                    'isCascadePersist' => true,
                ],
            ],
            [
                (new Cascade())->refresh(),
                [
                    'cascade' => [
                        'refresh',
                    ],
                    'isCascadeRefresh' => true,
                ],
            ],
            [
                (new Cascade())->remove(),
                [
                    'cascade' => [
                        'remove',
                    ],
                    'isCascadeRemove' => true,
                ],
            ],
        ];
    }

    public function discriminatorProvider(): array
    {
        return [
            [
                new Discriminator('type'),
                [
                    'defaultDiscriminatorValue' => null,
                    'discriminatorField' => 'type',
                    'discriminatorMap' => null,
                ],
            ],
            [
                (new Discriminator('type'))->default('physical'),
                [
                    'defaultDiscriminatorValue' => 'physical',
                    'discriminatorField' => 'type',
                    'discriminatorMap' => null,
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
