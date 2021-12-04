<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Database;

use yjiotpukc\MongoODMFluent\Builder\Database\InheritanceBuilder;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\BuilderTestCase;

class InheritanceTest extends BuilderTestCase
{
    public function testSingleCollectionInheritance()
    {
        $builder = InheritanceBuilder::singleCollection();
        $builder->build($this->metadata);

        self::assertTrue($this->metadata->isInheritanceTypeSingleCollection());
    }

    public function testCollectionPerClassInheritance()
    {
        $builder = InheritanceBuilder::collectionPerClass();
        $builder->build($this->metadata);

        self::assertTrue($this->metadata->isInheritanceTypeCollectionPerClass());
    }
}
