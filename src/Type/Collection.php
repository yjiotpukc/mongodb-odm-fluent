<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type;

interface Collection
{
    public function cappedAt(int $size, int $max): Collection;
}
