<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Document;

use yjiotpukc\MongoODMFluent\Mapping\Mapping;

interface Document extends Mapping
{
    public function map(\yjiotpukc\MongoODMFluent\Builder\Document $builder): void;
}
