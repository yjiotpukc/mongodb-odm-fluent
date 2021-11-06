<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Field;

interface FieldPartial
{
    public function toMapping(): array;
}
