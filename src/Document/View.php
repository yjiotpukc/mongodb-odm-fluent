<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Document;

use yjiotpukc\MongoODMFluent\Mapping\Mapping;

interface View extends Mapping
{
    public function map(\yjiotpukc\MongoODMFluent\Builder\View $builder): void;
}
