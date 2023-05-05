<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Database;

use yjiotpukc\MongoODMFluent\Builder\Database\IndexBuilder;
use yjiotpukc\MongoODMFluent\MappingException;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\BuilderTestCase;

class IndexTest extends BuilderTestCase
{
    public function testOneFieldIndex(): void
    {
        $builder = new IndexBuilder('id');
        $builder->build($this->metadata);

        self::assertSame([
            [
                'keys' => ['id' => 1],
                'options' => [
                    'unique' => false,
                    'sparse' => false,
                ],
            ],
        ], $this->metadata->indexes);
    }

    public function testOneFieldDescIndex(): void
    {
        $builder = new IndexBuilder(['id' => 'desc']);
        $builder->build($this->metadata);

        self::assertSame([
            [
                'keys' => ['id' => -1],
                'options' => [
                    'unique' => false,
                    'sparse' => false,
                ],
            ],
        ], $this->metadata->indexes);
    }

    public function testDescMethodWithoutArguments(): void
    {
        $builder = (new IndexBuilder('id'))->desc();
        $builder->build($this->metadata);

        self::assertSame([
            [
                'keys' => ['id' => -1],
                'options' => [
                    'unique' => false,
                    'sparse' => false,
                ],
            ],
        ], $this->metadata->indexes);
    }

    public function testDescMethodWithoutArgumentsAndWithoutKeys(): void
    {
        $this->expectException(MappingException::class);
        $this->expectExceptionMessage('Index::desc without arguments can be used only if exactly one key was provided');

        (new IndexBuilder())->desc();
    }

    public function testOneFieldGeoIndex(): void
    {
        $builder = new IndexBuilder(['id' => 'geo']);
        $builder->build($this->metadata);

        self::assertSame([
            [
                'keys' => ['id' => 'geo'],
                'options' => [
                    'unique' => false,
                    'sparse' => false,
                ],
            ],
        ], $this->metadata->indexes);
    }

    public function testGeoMethodWithoutArguments(): void
    {
        $builder = (new IndexBuilder('id'))->geo();
        $builder->build($this->metadata);

        self::assertSame([
            [
                'keys' => ['id' => 'geo'],
                'options' => [
                    'unique' => false,
                    'sparse' => false,
                ],
            ],
        ], $this->metadata->indexes);
    }

    public function testGeoMethodWithoutArgumentsAndWithoutKeys(): void
    {
        $this->expectException(MappingException::class);
        $this->expectExceptionMessage('Index::geo without arguments can be used only if exactly one key was provided');

        (new IndexBuilder())->geo();
    }

    public function testOneFieldTextIndex(): void
    {
        $builder = new IndexBuilder(['id' => 'text']);
        $builder->build($this->metadata);

        self::assertSame([
            [
                'keys' => ['id' => 'text'],
                'options' => [
                    'unique' => false,
                    'sparse' => false,
                ],
            ],
        ], $this->metadata->indexes);
    }

    public function testTextMethodWithoutArguments(): void
    {
        $builder = (new IndexBuilder('id'))->text();
        $builder->build($this->metadata);

        self::assertSame([
            [
                'keys' => ['id' => 'text'],
                'options' => [
                    'unique' => false,
                    'sparse' => false,
                ],
            ],
        ], $this->metadata->indexes);
    }

    public function testTextMethodWithoutArgumentsAndWithoutKeys(): void
    {
        $this->expectException(MappingException::class);
        $this->expectExceptionMessage('Index::text without arguments can be used only if exactly one key was provided');

        (new IndexBuilder())->text();
    }

    public function testTwoFieldIndex(): void
    {
        $builder = new IndexBuilder(['id', 'name']);
        $builder->build($this->metadata);

        self::assertSame([
            [
                'keys' => [
                    'id' => 1,
                    'name' => 1,
                ],
                'options' => [
                    'unique' => false,
                    'sparse' => false,
                ],
            ],
        ], $this->metadata->indexes);
    }

    public function testTwoFieldIndexWithOrder(): void
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
                'options' => [
                    'unique' => false,
                    'sparse' => false,
                ],
            ],
        ], $this->metadata->indexes);
    }

    public function testAscAndDescMethods(): void
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
                'options' => [
                    'unique' => false,
                    'sparse' => false,
                ],
            ],
        ], $this->metadata->indexes);
    }

    public function testUniqueIndex(): void
    {
        $builder = (new IndexBuilder('id'));
        $builder->unique();
        $builder->build($this->metadata);

        self::assertSame([
            [
                'keys' => ['id' => 1],
                'options' => [
                    'unique' => true,
                    'sparse' => false,
                ],
            ],
        ], $this->metadata->indexes);
    }

    public function testBackgroundIndex(): void
    {
        $builder = (new IndexBuilder('id'));
        $builder->background();
        $builder->build($this->metadata);

        self::assertSame([
            [
                'keys' => ['id' => 1],
                'options' => [
                    'unique' => false,
                    'sparse' => false,
                    'background' => true,
                ],
            ],
        ], $this->metadata->indexes);
    }

    public function testNamedIndex(): void
    {
        $builder = (new IndexBuilder('id'));
        $builder->name('myIndex');
        $builder->build($this->metadata);

        self::assertSame([
            [
                'keys' => ['id' => 1],
                'options' => [
                    'unique' => false,
                    'sparse' => false,
                    'name' => 'myIndex',
                ],
            ],
        ], $this->metadata->indexes);
    }

    public function testIndexWithExpireAfter(): void
    {
        $builder = (new IndexBuilder('id'));
        $builder->expireAfter(72);
        $builder->build($this->metadata);

        self::assertSame([
            [
                'keys' => ['id' => 1],
                'options' => [
                    'unique' => false,
                    'sparse' => false,
                    'expireAfterSeconds' => 72
                ],
            ],
        ], $this->metadata->indexes);
    }

    public function testSparseIndex(): void
    {
        $builder = (new IndexBuilder('id'));
        $builder->sparse();
        $builder->build($this->metadata);

        self::assertSame([
            [
                'keys' => ['id' => 1],
                'options' => [
                    'unique' => false,
                    'sparse' => true,
                ],
            ],
        ], $this->metadata->indexes);
    }

    public function testIndexWithPartialFilter(): void
    {
        $builder = (new IndexBuilder('id'));
        $builder->partialFilter('condition: true');
        $builder->build($this->metadata);

        self::assertSame([
            [
                'keys' => ['id' => 1],
                'options' => [
                    'unique' => false,
                    'sparse' => false,
                    'partialFilterExpression' => 'condition: true',
                ],
            ],
        ], $this->metadata->indexes);
    }
}
