<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Database;

use yjiotpukc\MongoODMFluent\Builder\Database\Inheritance;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\BuilderTestCase;

class InheritanceTest extends BuilderTestCase
{
    public function testSingleCollectionInheritance()
    {
        $this->builder = Inheritance::singleCollection();
        $this->builder->build($this->metadata);

        self::assertTrue($this->metadata->isInheritanceTypeSingleCollection());
    }

    public function testCollectionPerClassInheritance()
    {
        $this->builder = Inheritance::collectionPerClass();
        $this->builder->build($this->metadata);

        self::assertTrue($this->metadata->isInheritanceTypeCollectionPerClass());
    }
}
