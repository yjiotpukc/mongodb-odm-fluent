<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Database;

use yjiotpukc\MongoODMFluent\Builder\Database\ReadOnly;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\BuilderTestCase;

class ReadOnlyTest extends BuilderTestCase
{
    public function testReadOnly()
    {
        $this->builder = new ReadOnly();
        $this->builder->build($this->metadata);

        static::assertTrue($this->metadata->isReadOnly);
    }
}
