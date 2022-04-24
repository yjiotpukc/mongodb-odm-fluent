<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Document;

use yjiotpukc\MongoODMFluent\Mapping\Mapping;
use yjiotpukc\MongoODMFluent\Mapping\QueryResultDocumentMapping;

interface QueryResultDocument extends Mapping
{
    public function map(QueryResultDocumentMapping $mapping): void;
}
