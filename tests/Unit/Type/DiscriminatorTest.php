<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Type;

use PHPUnit\Framework\TestCase;
use yjiotpukc\MongoODMFluent\Type\Discriminator;

class DiscriminatorTest extends TestCase
{
    public function testEmpty()
    {
        $discriminator = new Discriminator('fieldName');

        self::assertSame(null, $discriminator->defaultValue);
        self::assertSame('fieldName', $discriminator->field);
        self::assertSame([], $discriminator->map);
    }

    public function testWithOneMapEntry()
    {
        $discriminator = (new Discriminator('fieldName'))->map('key', 'value');

        self::assertSame(null, $discriminator->defaultValue);
        self::assertSame('fieldName', $discriminator->field);
        self::assertSame(['key' => 'value'], $discriminator->map);
    }

    public function testWithThreeMapEntries()
    {
        $discriminator = (new Discriminator('fieldName'))
            ->map('key1', 'value1')
            ->map('key2', 'value2')
            ->map('key3', 'value3');

        self::assertSame(null, $discriminator->defaultValue);
        self::assertSame('fieldName', $discriminator->field);
        self::assertSame([
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => 'value3',
        ], $discriminator->map);
    }

    public function testDefaultValue()
    {
        $discriminator = (new Discriminator('fieldName'))->map('key', 'value')->default('key');

        self::assertSame('key', $discriminator->defaultValue);
        self::assertSame('fieldName', $discriminator->field);
        self::assertSame(['key' => 'value'], $discriminator->map);
    }
}
