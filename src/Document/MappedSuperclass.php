<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Document;

use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;
use yjiotpukc\MongoODMFluent\Mapping\Mapping;

interface MappedSuperclass extends Mapping
{
    public static function map(DocumentMapping $mapping): void;
}
