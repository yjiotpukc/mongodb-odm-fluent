<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Document;

use yjiotpukc\MongoODMFluent\Mapping\FileMapping;
use yjiotpukc\MongoODMFluent\Mapping\Mapping;

interface File extends Mapping
{
    public function map(FileMapping $builder): void;
}
