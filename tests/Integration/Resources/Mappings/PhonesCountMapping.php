<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Mappings;

use yjiotpukc\MongoODMFluent\Builder\QueryResultDocument;
use yjiotpukc\MongoODMFluent\Mapping\QueryResultDocumentMapping;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\PhonesCount;

class PhonesCountMapping extends QueryResultDocumentMapping
{
    public function mapFor(): string
    {
        return PhonesCount::class;
    }

    public function map(QueryResultDocument $builder): void
    {
        $builder->int('count');
    }
}
