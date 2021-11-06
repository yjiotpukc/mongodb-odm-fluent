<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Database;

use yjiotpukc\MongoODMFluent\Builder\Database\DiscriminatorBuilder;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\BuilderTestCase;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Traits\DiscriminatorProvider;

class DiscriminatorTest extends BuilderTestCase
{
    use DiscriminatorProvider;

    /**
     * @dataProvider discriminatorProvider
     */
    public function testDiscriminator(DiscriminatorBuilder $discriminator, array $expected)
    {
        $discriminator->build($this->metadata);

        self::assertSame($expected['defaultDiscriminatorValue'], $this->metadata->defaultDiscriminatorValue);
        self::assertSame($expected['discriminatorField'], $this->metadata->discriminatorField);
        self::assertSame($expected['discriminatorMap'], $this->metadata->discriminatorMap);
    }
}
