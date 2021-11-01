<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder;

use yjiotpukc\MongoODMFluent\Builder\MappedSuperclassBuilder;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Traits\TestDb;

class MappedSuperclassBuilderTest extends BuilderBaseTestCase
{
    use TestDb;

    public function givenEmptyBuilder(): MappedSuperclassBuilder
    {
        return new MappedSuperclassBuilder();
    }
}
