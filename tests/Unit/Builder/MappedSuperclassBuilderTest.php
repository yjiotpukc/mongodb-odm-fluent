<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder;

use yjiotpukc\MongoODMFluent\Builder\Document\MappedSuperclassBuilder;

class MappedSuperclassBuilderTest extends BuilderBaseTestCase
{
    public function givenBuilder(): MappedSuperclassBuilder
    {
        return new MappedSuperclassBuilder();
    }
}
