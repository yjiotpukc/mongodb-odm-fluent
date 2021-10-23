<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type;

interface MappableField
{
    public function map(): array;
}
