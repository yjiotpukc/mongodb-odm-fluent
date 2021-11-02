<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder;

use yjiotpukc\MongoODMFluent\Builder\MappedSuperclassBuilder;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Traits\TestCollection;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Traits\TestDb;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Traits\TestField;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Traits\TestId;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Traits\TestReferenceMany;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Traits\TestReferenceOne;

class MappedSuperclassBuilderTest extends BuilderBaseTestCase
{
    use TestDb;
    use TestCollection;
    use TestId;
    use TestField;
    use TestReferenceOne;
    use TestReferenceMany;

    public function givenEmptyBuilder(): MappedSuperclassBuilder
    {
        return new MappedSuperclassBuilder();
    }
}
