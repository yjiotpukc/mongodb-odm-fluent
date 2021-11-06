<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Database;

use yjiotpukc\MongoODMFluent\Builder\Database\DiscriminatorBuilder;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\AnotherEntityStub;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\BuilderTestCase;

class DiscriminatorTest extends BuilderTestCase
{
    public function testDefaultDiscriminator()
    {
        $discriminator = new DiscriminatorBuilder('type');

        $discriminator->build($this->metadata);

        self::assertSame('type', $this->metadata->discriminatorField);
        self::assertSame(null, $this->metadata->defaultDiscriminatorValue);
        self::assertSame([], $this->metadata->discriminatorMap);
    }

    public function testDiscriminatorWithDefaultValue()
    {
        $discriminator = new DiscriminatorBuilder('type');
        $discriminator->map('physical', AnotherEntityStub::class)->default('physical');

        $discriminator->build($this->metadata);

        self::assertSame('type', $this->metadata->discriminatorField);
        self::assertSame('physical', $this->metadata->defaultDiscriminatorValue);
        self::assertSame(['physical' => AnotherEntityStub::class], $this->metadata->discriminatorMap);
    }

    public function testDiscriminatorWithMap()
    {
        $discriminator = new DiscriminatorBuilder('type');
        $discriminator
            ->map('email', AnotherEntityStub::class)
            ->map('physical', AnotherEntityStub::class);

        $discriminator->build($this->metadata);

        self::assertSame('type', $this->metadata->discriminatorField);
        self::assertSame(null, $this->metadata->defaultDiscriminatorValue);
        self::assertSame([
            'email' => AnotherEntityStub::class,
            'physical' => AnotherEntityStub::class,
        ], $this->metadata->discriminatorMap);
    }
}
