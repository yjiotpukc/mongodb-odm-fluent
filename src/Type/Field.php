<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type;

interface Field
{
    public function __construct(string $type, string $fieldName);

    public function nameInDb(string $name): Field;

    public function nullable(): Field;

    public function notSaved(): Field;
}
