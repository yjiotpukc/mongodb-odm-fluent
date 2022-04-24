<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Mappings;

use yjiotpukc\MongoODMFluent\Document\QueryResultDocument;
use yjiotpukc\MongoODMFluent\Mapping\QueryResultDocumentMapping;

class PhonesCountMapping implements QueryResultDocument
{
    public function map(QueryResultDocumentMapping $builder): void
    {
        $builder->int('count');
    }
}
