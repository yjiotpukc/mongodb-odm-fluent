<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Database;

use yjiotpukc\MongoODMFluent\Builder\Database\RepositoryClassBuilder;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\BuilderTestCase;

class RepositoryClassTest extends BuilderTestCase
{
    public function testRepositoryClass(): void
    {
        $builder = new RepositoryClassBuilder('RepositoryClassname');
        $builder->build($this->metadata);

        self::assertSame('RepositoryClassname', $this->metadata->customRepositoryClassName);
    }
}
