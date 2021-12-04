<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Builder;

class QueryResultDocumentBuilder implements Builder
{
    public function build(ClassMetadata $metadata): void
    {
        $metadata->isQueryResultDocument = true;
    }
}
