<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Document;

use yjiotpukc\MongoODMFluent\Mapping\Mapping;
use yjiotpukc\MongoODMFluent\Mapping\ViewMapping;

interface View extends Mapping
{
    public function map(ViewMapping $mapping): void;
}
