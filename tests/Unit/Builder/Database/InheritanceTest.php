<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Database;

use yjiotpukc\MongoODMFluent\Builder\Database\InheritanceBuilder;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\BuilderTestCase;

class InheritanceTest extends BuilderTestCase
{
    public function testSingleCollectionInheritance(): void
    {
        $builder = InheritanceBuilder::singleCollection();
        $builder->build($this->metadata);

        self::assertTrue($this->metadata->isInheritanceTypeSingleCollection());
    }

    public function testCollectionPerClassInheritance(): void
    {
        $builder = InheritanceBuilder::collectionPerClass();
        $builder->build($this->metadata);

        self::assertTrue($this->metadata->isInheritanceTypeCollectionPerClass());
    }
}
