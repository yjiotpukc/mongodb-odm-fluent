<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Traits;

use yjiotpukc\MongoODMFluent\Buildable\Field as FieldImplementation;
use yjiotpukc\MongoODMFluent\Type\Field;

trait CanHaveFields
{
    use AbstractBuilderTrait;

    public function field(string $type, string $fieldName): Field
    {
        return $this->addBuildable(new FieldImplementation($type, $fieldName));
    }
}
