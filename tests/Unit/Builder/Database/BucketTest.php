<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Database;

use yjiotpukc\MongoODMFluent\Builder\Database\BucketBuilder;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\BuilderTestCase;

class BucketTest extends BuilderTestCase
{
    public function testBucket(): void
    {
        $builder = new BucketBuilder('images');
        $builder->build($this->metadata);

        static::assertSame('images', $this->metadata->getBucketName());
    }
}
