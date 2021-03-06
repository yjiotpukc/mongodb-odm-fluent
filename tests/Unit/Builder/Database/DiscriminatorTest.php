<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Database;

use yjiotpukc\MongoODMFluent\Builder\Database\DiscriminatorBuilder;
use yjiotpukc\MongoODMFluent\Tests\Stubs\AnotherEntityStub;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\BuilderTestCase;

class DiscriminatorTest extends BuilderTestCase
{
    public function testDefaultDiscriminator(): void
    {
        $discriminatorBuilder = new DiscriminatorBuilder('type');

        $discriminatorBuilder->build($this->metadata);

        self::assertSame('type', $this->metadata->discriminatorField);
        self::assertNull($this->metadata->defaultDiscriminatorValue);
        self::assertSame([], $this->metadata->discriminatorMap);
    }

    public function testDiscriminatorWithDefaultValue(): void
    {
        $discriminatorBuilder = new DiscriminatorBuilder('type');
        $discriminatorBuilder->map('physical', AnotherEntityStub::class)->default('physical');

        $discriminatorBuilder->build($this->metadata);

        self::assertSame('type', $this->metadata->discriminatorField);
        self::assertSame('physical', $this->metadata->defaultDiscriminatorValue);
        self::assertSame(['physical' => AnotherEntityStub::class], $this->metadata->discriminatorMap);
    }

    public function testDiscriminatorWithMap(): void
    {
        $discriminatorBuilder = new DiscriminatorBuilder('type');
        $discriminatorBuilder
            ->map('email', AnotherEntityStub::class)
            ->map('physical', AnotherEntityStub::class);

        $discriminatorBuilder->build($this->metadata);

        self::assertSame('type', $this->metadata->discriminatorField);
        self::assertNull($this->metadata->defaultDiscriminatorValue);
        self::assertSame([
            'email' => AnotherEntityStub::class,
            'physical' => AnotherEntityStub::class,
        ], $this->metadata->discriminatorMap);
    }
}
