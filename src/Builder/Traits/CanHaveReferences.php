<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Traits;

use yjiotpukc\MongoODMFluent\Buildable\ReferenceMany as ReferenceManyImplementation;
use yjiotpukc\MongoODMFluent\Buildable\ReferenceOne as ReferenceOneImplementation;
use yjiotpukc\MongoODMFluent\Type\ReferenceMany;
use yjiotpukc\MongoODMFluent\Type\ReferenceOne;

trait CanHaveReferences
{
    use AbstractBuilderTrait;

    public function referenceOne(string $fieldName, string $target = ''): ReferenceOne
    {
        return $this->addBuildable(new ReferenceOneImplementation($fieldName, $target));
    }

    public function referenceMany(string $fieldName, string $target = ''): ReferenceMany
    {
        return $this->addBuildable(new ReferenceManyImplementation($fieldName, $target));
    }
}
