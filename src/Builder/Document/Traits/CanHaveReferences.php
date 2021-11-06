<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document\Traits;

use yjiotpukc\MongoODMFluent\Builder\Field\ReferenceManyBuilder;
use yjiotpukc\MongoODMFluent\Builder\Field\ReferenceOneBuilder;
use yjiotpukc\MongoODMFluent\Type\ReferenceMany;
use yjiotpukc\MongoODMFluent\Type\ReferenceOne;

trait CanHaveReferences
{
    public function referenceOne(string $fieldName, string $target = ''): ReferenceOne
    {
        return $this->addBuilder(new ReferenceOneBuilder($fieldName, $target));
    }

    public function referenceMany(string $fieldName, string $target = ''): ReferenceMany
    {
        return $this->addBuilder(new ReferenceManyBuilder($fieldName, $target));
    }
}
