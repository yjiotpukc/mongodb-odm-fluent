<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Mapping;

use yjiotpukc\MongoODMFluent\Mapping\Traits\QueryResultDocumentMappingTrait;

abstract class QueryResultDocumentMapping implements Mapping
{
    use QueryResultDocumentMappingTrait;
}
