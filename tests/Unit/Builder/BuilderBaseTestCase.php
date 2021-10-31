<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder;

use PHPUnit\Framework\TestCase;
use yjiotpukc\MongoODMFluent\Buildable\EmbedMany;
use yjiotpukc\MongoODMFluent\Buildable\EmbedOne;
use yjiotpukc\MongoODMFluent\Buildable\Field;
use yjiotpukc\MongoODMFluent\Buildable\Id;
use yjiotpukc\MongoODMFluent\Buildable\ReferenceMany;
use yjiotpukc\MongoODMFluent\Buildable\ReferenceOne;
use yjiotpukc\MongoODMFluent\Tests\Stubs\BaseBuilderStub;

abstract class BuilderBaseTestCase extends TestCase
{
    /**
     * @dataProvider methodProvider
     */
    public function testBuilderAddsField(BaseBuilderStub $builder, string $method, array $arguments)
    {
        $field = $builder->$method(...$arguments);

        self::assertTrue(in_array($field, $builder->getFields(), true));
    }

    /**
     * @dataProvider methodProvider
     */
    public function testBuilderAddsOnlyOneField(BaseBuilderStub $builder, string $method, array $arguments)
    {
        $previousCount = count($builder->getFields());

        $builder->$method(...$arguments);
        $currentCount = count($builder->getFields());

        self::assertEquals(1, $currentCount - $previousCount);
    }

    /**
     * @dataProvider methodProvider
     */
    public function testBuilderDoesNotModifyConstructorArguments(BaseBuilderStub $builder, string $method, array $arguments, string $className)
    {
        $expected = new $className(...$arguments);

        $field = $builder->$method(...$arguments);

        self::assertEquals($expected, $field);
    }

    public function methodProvider(): array
    {
        return [
            [$this->givenEmptyBuilder(), 'id', [], Id::class],
            [$this->givenEmptyBuilder(), 'field', ['type', 'fieldName'], Field::class],
            [$this->givenEmptyBuilder(), 'embedOne', ['field', 'target'], EmbedOne::class],
            [$this->givenEmptyBuilder(), 'embedMany', ['field', 'target'], EmbedMany::class],
            [$this->givenEmptyBuilder(), 'referenceOne', ['field', 'target'], ReferenceOne::class],
            [$this->givenEmptyBuilder(), 'referenceMany', ['field', 'target'], ReferenceMany::class],

            [$this->givenBuilderWithId(), 'field', ['type', 'fieldName'], Field::class],
            [$this->givenBuilderWithId(), 'embedOne', ['field', 'target'], EmbedOne::class],
            [$this->givenBuilderWithId(), 'embedMany', ['field', 'target'], EmbedMany::class],
            [$this->givenBuilderWithId(), 'referenceOne', ['field', 'target'], ReferenceOne::class],
            [$this->givenBuilderWithId(), 'referenceMany', ['field', 'target'], ReferenceMany::class],

            [$this->givenBuilderWithSomeFields(), 'field', ['type', 'fieldName'], Field::class],
            [$this->givenBuilderWithSomeFields(), 'embedOne', ['field', 'target'], EmbedOne::class],
            [$this->givenBuilderWithSomeFields(), 'embedMany', ['field', 'target'], EmbedMany::class],
            [$this->givenBuilderWithSomeFields(), 'referenceOne', ['field', 'target'], ReferenceOne::class],
            [$this->givenBuilderWithSomeFields(), 'referenceMany', ['field', 'target'], ReferenceMany::class],
        ];
    }

    abstract public function givenEmptyBuilder();

    abstract public function givenBuilderWithId();

    abstract public function givenBuilderWithSomeFields();
}
