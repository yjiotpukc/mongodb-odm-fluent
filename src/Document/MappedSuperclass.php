<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Document;

use yjiotpukc\MongoODMFluent\Builder\Document;
use yjiotpukc\MongoODMFluent\Mapping\Mapping;

interface MappedSuperclass extends Mapping
{
    public function map(Document $builder): void;
}
