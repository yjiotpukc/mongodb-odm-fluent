<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Traits;

trait TestCollection
{
    public function testCollection()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->collection('someName');
        $builder->build($metadata);

        static::assertSame('someName', $metadata->collection);
    }
}
