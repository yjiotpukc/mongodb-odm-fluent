<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type;

interface Discriminator
{
    public function __construct(string $field);

    public function map(string $value, string $class): Discriminator;

    public function default($value): Discriminator;
}
