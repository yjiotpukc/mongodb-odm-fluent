<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Database;

use yjiotpukc\MongoODMFluent\Builder\Database\RootClassBuilder;
use yjiotpukc\MongoODMFluent\Builder\Database\ViewNameBuilder;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\AnotherEntityStub;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\BuilderTestCase;

class ViewNameTest extends BuilderTestCase
{
    public function testViewName(): void
    {
        $builder = new ViewNameBuilder('my_view');
        $builder->build($this->metadata);

        static::assertSame('my_view', $this->metadata->getCollection());
    }
}
