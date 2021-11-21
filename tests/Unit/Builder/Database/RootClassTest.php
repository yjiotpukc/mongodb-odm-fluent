<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Database;

use yjiotpukc\MongoODMFluent\Builder\Database\RootClassBuilder;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\AnotherEntityStub;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\BuilderTestCase;

class RootClassTest extends BuilderTestCase
{
    public function testRootClass(): void
    {
        $builder = new RootClassBuilder(AnotherEntityStub::class);
        $builder->build($this->metadata);

        static::assertSame(AnotherEntityStub::class, $this->metadata->getRootClass());
    }
}
