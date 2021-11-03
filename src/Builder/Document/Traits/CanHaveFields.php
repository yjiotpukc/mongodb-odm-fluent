<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document\Traits;

use yjiotpukc\MongoODMFluent\Builder\Field\Field as FieldImplementation;
use yjiotpukc\MongoODMFluent\Type\Field;

trait CanHaveFields
{
    public function field(string $type, string $fieldName): Field
    {
        return $this->addBuilder(new FieldImplementation($type, $fieldName));
    }
}
