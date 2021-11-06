<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Database;

use yjiotpukc\MongoODMFluent\Builder\Database\RepositoryClassBuilder;
use yjiotpukc\MongoODMFluent\Tests\Stubs\RepositoryStub;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\BuilderTestCase;

class RepositoryClassTest extends BuilderTestCase
{
    public function testRepositoryClass()
    {
        $this->builder = new RepositoryClassBuilder(RepositoryStub::class);
        $this->builder->build($this->metadata);

        self::assertSame(RepositoryStub::class, $this->metadata->customRepositoryClassName);
    }
}
