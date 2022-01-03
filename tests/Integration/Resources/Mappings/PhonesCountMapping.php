<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Mappings;

use yjiotpukc\MongoODMFluent\Builder\QueryResultDocument;
use yjiotpukc\MongoODMFluent\Mapping\QueryResultDocumentMapping;

class PhonesCountMapping extends QueryResultDocumentMapping
{
    public function map(QueryResultDocument $builder): void
    {
        $builder->int('count');
    }
}
