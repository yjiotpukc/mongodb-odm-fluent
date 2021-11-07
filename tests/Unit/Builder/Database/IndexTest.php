<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Database;

use yjiotpukc\MongoODMFluent\Builder\Database\IndexBuilder;
use yjiotpukc\MongoODMFluent\MappingException;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\BuilderTestCase;

class IndexTest extends BuilderTestCase
{
    public function testOneFieldIndex()
    {
        $builder = new IndexBuilder('id');
        $builder->build($this->metadata);

        self::assertSame([
            [
                'keys' => ['id' => 1],
                'options' => [],
            ],
        ], $this->metadata->indexes);
    }

    public function testOneFieldDescIndex()
    {
        $builder = new IndexBuilder(['id' => 'desc']);
        $builder->build($this->metadata);

        self::assertSame([
            [
                'keys' => ['id' => -1],
                'options' => [],
            ],
        ], $this->metadata->indexes);
    }

    public function testDescMethodWithoutArguments()
    {
        $builder = (new IndexBuilder('id'))->desc();
        $builder->build($this->metadata);

        self::assertSame([
            [
                'keys' => ['id' => -1],
                'options' => [],
            ],
        ], $this->metadata->indexes);
    }

    public function testDescMethodWithoutArgumentsAndWithoutKeys()
    {
        $this->expectException(MappingException::class);
        $this->expectExceptionMessage('Index::desc without arguments can be used only if exactly one key was provided');

        (new IndexBuilder())->desc();
    }

    public function testTwoFieldIndex()
    {
        $builder = new IndexBuilder(['id', 'name']);
        $builder->build($this->metadata);

        self::assertSame([
            [
                'keys' => [
                    'id' => 1,
                    'name' => 1,
                ],
                'options' => [],
            ],
        ], $this->metadata->indexes);
    }

    public function testTwoFieldIndexWithOrder()
    {
        $builder = new IndexBuilder([
            'id' => 'desc',
            'name' => 'asc',
        ]);
        $builder->build($this->metadata);

        self::assertSame([
            [
                'keys' => [
                    'id' => -1,
                    'name' => 1,
                ],
                'options' => [],
            ],
        ], $this->metadata->indexes);
    }

    public function testAscAndDescMethods()
    {
        $builder = new IndexBuilder();
        $builder->asc('id')->desc('name');
        $builder->build($this->metadata);

        self::assertSame([
            [
                'keys' => [
                    'id' => 1,
                    'name' => -1,
                ],
                'options' => [],
            ],
        ], $this->metadata->indexes);
    }

    public function testUniqueIndex()
    {
        $builder = (new IndexBuilder('id'));
        $builder->unique();
        $builder->build($this->metadata);

        self::assertSame([
            [
                'keys' => ['id' => 1],
                'options' => ['unique' => true],
            ],
        ], $this->metadata->indexes);
    }

    public function testBackgroundIndex()
    {
        $builder = (new IndexBuilder('id'));
        $builder->background();
        $builder->build($this->metadata);

        self::assertSame([
            [
                'keys' => ['id' => 1],
                'options' => ['background' => true],
            ],
        ], $this->metadata->indexes);
    }

    public function testNamedIndex()
    {
        $builder = (new IndexBuilder('id'));
        $builder->name('myIndex');
        $builder->build($this->metadata);

        self::assertSame([
            [
                'keys' => ['id' => 1],
                'options' => ['name' => 'myIndex'],
            ],
        ], $this->metadata->indexes);
    }

    public function testIndexWithExpireAfter()
    {
        $builder = (new IndexBuilder('id'));
        $builder->expireAfter(72);
        $builder->build($this->metadata);

        self::assertSame([
            [
                'keys' => ['id' => 1],
                'options' => ['expireAfterSeconds' => 72],
            ],
        ], $this->metadata->indexes);
    }

    public function testSparseIndex()
    {
        $builder = (new IndexBuilder('id'));
        $builder->sparse();
        $builder->build($this->metadata);

        self::assertSame([
            [
                'keys' => ['id' => 1],
                'options' => ['sparse' => true],
            ],
        ], $this->metadata->indexes);
    }

    public function testIndexWithPartialFilter()
    {
        $builder = (new IndexBuilder('id'));
        $builder->partialFilter('condition: true');
        $builder->build($this->metadata);

        self::assertSame([
            [
                'keys' => ['id' => 1],
                'options' => ['partialFilterExpression' => 'condition: true'],
            ],
        ], $this->metadata->indexes);
    }
}
