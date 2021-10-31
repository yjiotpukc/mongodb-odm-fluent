<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder;

use yjiotpukc\MongoODMFluent\Tests\Stubs\BaseBuilderStub;

class BaseBuilderTest extends BuilderBaseTestCase
{
    public function givenEmptyBuilder(): BaseBuilderStub
    {
        return new BaseBuilderStub();
    }

    public function givenBuilderWithId(): BaseBuilderStub
    {
        $builder = new BaseBuilderStub();
        $builder->id();

        return $builder;
    }

    public function givenBuilderWithSomeFields(): BaseBuilderStub
    {
        $builder = new BaseBuilderStub();
        $builder->field('string', 'firstName');
        $builder->field('string', 'lastName');
        $builder->field('int', 'age');

        return $builder;
    }
}
