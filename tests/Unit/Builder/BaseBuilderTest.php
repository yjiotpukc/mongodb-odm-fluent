<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder;

use PHPUnit\Framework\TestCase;
use yjiotpukc\MongoODMFluent\Tests\Stubs\BaseBuilderStub;
use yjiotpukc\MongoODMFluent\Type\Implementation\EmbedMany;
use yjiotpukc\MongoODMFluent\Type\Implementation\EmbedOne;
use yjiotpukc\MongoODMFluent\Type\Implementation\Field;
use yjiotpukc\MongoODMFluent\Type\Implementation\Id;
use yjiotpukc\MongoODMFluent\Type\Implementation\ReferenceMany;
use yjiotpukc\MongoODMFluent\Type\Implementation\ReferenceOne;

class BaseBuilderTest extends TestCase
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

    public function givenEmptyBuilder(): BaseBuilderStub
    {
        return new BaseBuilderStub();
    }

    public function givenBuilderWithId(): BaseBuilderStub
    {
        $builder = new BaseBuilderStub();
        $builder->id();

        return $builder;
    }

    public function givenBuilderWithSomeFields(): BaseBuilderStub
    {
        $builder = new BaseBuilderStub();
        $builder->field('string', 'firstName');
        $builder->field('string', 'lastName');
        $builder->field('int', 'age');

        return $builder;
    }
}
