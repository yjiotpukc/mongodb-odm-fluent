<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Document;

use yjiotpukc\MongoODMFluent\Mapping\FileMapping;
use yjiotpukc\MongoODMFluent\Mapping\Mapping;

interface File extends Mapping
{
    public static function map(FileMapping $mapping): void;
}
