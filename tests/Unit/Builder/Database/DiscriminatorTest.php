<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Database;

use yjiotpukc\MongoODMFluent\Builder\Database\Discriminator;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\BuilderTestCase;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Traits\DiscriminatorProvider;

class DiscriminatorTest extends BuilderTestCase
{
    use DiscriminatorProvider;

    /**
     * @dataProvider discriminatorProvider
     */
    public function testDiscriminator(\yjiotpukc\MongoODMFluent\Type\Discriminator $discriminator, array $expected)
    {
        $this->builder = new Discriminator($discriminator);
        $this->builder->build($this->metadata);

        self::assertSame($expected['defaultDiscriminatorValue'], $this->metadata->defaultDiscriminatorValue);
        self::assertSame($expected['discriminatorField'], $this->metadata->discriminatorField);
        self::assertSame($expected['discriminatorMap'], $this->metadata->discriminatorMap);
    }
}
