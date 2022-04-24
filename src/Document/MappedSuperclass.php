<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Document;

use yjiotpukc\MongoODMFluent\Builder\Document;

interface MappedSuperclass
{
    public function map(Document $builder): void;
}
