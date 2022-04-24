<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Document;

use yjiotpukc\MongoODMFluent\Mapping\Mapping;

interface QueryResultDocument extends Mapping
{
    public function map(\yjiotpukc\MongoODMFluent\Builder\QueryResultDocument $builder): void;
}
