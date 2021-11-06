<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Database;

use yjiotpukc\MongoODMFluent\Builder\Database\InheritanceBuilder;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\BuilderTestCase;

class InheritanceTest extends BuilderTestCase
{
    public function testSingleCollectionInheritance()
    {
        $this->builder = InheritanceBuilder::singleCollection();
        $this->builder->build($this->metadata);

        self::assertTrue($this->metadata->isInheritanceTypeSingleCollection());
    }

    public function testCollectionPerClassInheritance()
    {
        $this->builder = InheritanceBuilder::collectionPerClass();
        $this->builder->build($this->metadata);

        self::assertTrue($this->metadata->isInheritanceTypeCollectionPerClass());
    }
}
