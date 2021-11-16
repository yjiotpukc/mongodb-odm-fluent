<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type;

interface IntegerField
{
    public function __construct(string $type, string $fieldName);

    public function nameInDb(string $name): IntegerField;

    public function nullable(): IntegerField;

    public function notSaved(): IntegerField;

    public function increment(): IntegerField;
}
