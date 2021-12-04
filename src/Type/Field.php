<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type;

use yjiotpukc\MongoODMFluent\Builder\Field\FieldBuilder;

interface Field
{
    public function __construct(string $type, string $fieldName);

    public function nameInDb(string $name): Field;

    public function nullable(): Field;

    public function notSaved(): Field;

    public function version(): FieldBuilder;

    public function lock(): FieldBuilder;
}
