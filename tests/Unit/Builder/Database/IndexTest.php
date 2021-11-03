<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Database;

use yjiotpukc\MongoODMFluent\Builder\Database\Index;
use yjiotpukc\MongoODMFluent\MappingException;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\BuilderTestCase;

class IndexTest extends BuilderTestCase
{
    public function testOneFieldIndex()
    {
        $this->builder = new Index('id');
        $this->builder->build($this->metadata);

        self::assertSame([
            [
                'keys' => ['id' => 1],
                'options' => [],
            ]
        ], $this->metadata->indexes);
    }

    public function testOneFieldDescIndex()
    {
        $this->builder = new Index(['id' => 'desc']);
        $this->builder->build($this->metadata);

        self::assertSame([
            [
                'keys' => ['id' => -1],
                'options' => [],
            ]
        ], $this->metadata->indexes);
    }

    public function testDescMethodWithoutArguments()
    {
        $this->builder = (new Index('id'))->desc();
        $this->builder->build($this->metadata);

        self::assertSame([
            [
                'keys' => ['id' => -1],
                'options' => [],
            ]
        ], $this->metadata->indexes);
    }

    public function testDescMethodWithoutArgumentsAndWithoutKeys()
    {
        $this->expectException(MappingException::class);
        $this->expectExceptionMessage('Index::desc without arguments can be used only if exactly one key was provided');

        $this->builder = (new Index())->desc();
    }

    public function testTwoFieldIndex()
    {
        $this->builder = new Index(['id', 'name']);
        $this->builder->build($this->metadata);

        self::assertSame([
            [
                'keys' => [
                    'id' => 1,
                    'name' => 1,
                ],
                'options' => [],
            ]
        ], $this->metadata->indexes);
    }

    public function testTwoFieldIndexWithOrder()
    {
        $this->builder = new Index([
            'id' => 'desc',
            'name' => 'asc',
        ]);
        $this->builder->build($this->metadata);

        self::assertSame([
            [
                'keys' => [
                    'id' => -1,
                    'name' => 1,
                ],
                'options' => [],
            ]
        ], $this->metadata->indexes);
    }

    public function testAscAndDescMethods()
    {
        $this->builder = new Index();
        $this->builder->asc('id')->desc('name');
        $this->builder->build($this->metadata);

        self::assertSame([
            [
                'keys' => [
                    'id' => 1,
                    'name' => -1,
                ],
                'options' => [],
            ]
        ], $this->metadata->indexes);
    }

    public function testUniqueIndex()
    {
        $this->builder = (new Index('id'));
        $this->builder->unique();
        $this->builder->build($this->metadata);

        self::assertSame([
            [
                'keys' => ['id' => 1],
                'options' => ['unique' => true],
            ]
        ], $this->metadata->indexes);
    }

    public function testBackgroundIndex()
    {
        $this->builder = (new Index('id'));
        $this->builder->background();
        $this->builder->build($this->metadata);

        self::assertSame([
            [
                'keys' => ['id' => 1],
                'options' => ['background' => true],
            ]
        ], $this->metadata->indexes);
    }

    public function testNamedIndex()
    {
        $this->builder = (new Index('id'));
        $this->builder->name('myIndex');
        $this->builder->build($this->metadata);

        self::assertSame([
            [
                'keys' => ['id' => 1],
                'options' => ['name' => 'myIndex'],
            ]
        ], $this->metadata->indexes);
    }

    public function testIndexWithExpireAfter()
    {
        $this->builder = (new Index('id'));
        $this->builder->expireAfter(72);
        $this->builder->build($this->metadata);

        self::assertSame([
            [
                'keys' => ['id' => 1],
                'options' => ['expireAfterSeconds' => 72],
            ]
        ], $this->metadata->indexes);
    }

    public function testSparseIndex()
    {
        $this->builder = (new Index('id'));
        $this->builder->sparse();
        $this->builder->build($this->metadata);

        self::assertSame([
            [
                'keys' => ['id' => 1],
                'options' => ['sparse' => true],
            ]
        ], $this->metadata->indexes);
    }

    public function testIndexWithPartialFilter()
    {
        $this->builder = (new Index('id'));
        $this->builder->partialFilter('condition: true');
        $this->builder->build($this->metadata);

        self::assertSame([
            [
                'keys' => ['id' => 1],
                'options' => ['partialFilterExpression' => 'condition: true'],
            ]
        ], $this->metadata->indexes);
    }
}
