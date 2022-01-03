<?php

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Method;

use yjiotpukc\MongoODMFluent\Builder\Method\AlsoLoadMethodBuilder;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\BuilderTestCase;

class AlsoLoadMethodBuilderTest extends BuilderTestCase
{
    public function testAlsoLoadMethod(): void
    {
        $builder = new AlsoLoadMethodBuilder('populateFirstAndLastName', ['name', 'fullName']);

        $builder->build($this->metadata);

        self::assertSameArray([
            'populateFirstAndLastName' => ['name', 'fullName']
        ], $this->metadata->alsoLoadMethods);
    }
}
