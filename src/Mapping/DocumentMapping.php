<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Mapping;

use yjiotpukc\MongoODMFluent\Mapping\Traits\DocumentMappingTrait;

abstract class DocumentMapping implements Mapping
{
    use DocumentMappingTrait;
}
