<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Mappings;

use yjiotpukc\MongoODMFluent\Builder\QueryResultDocument;

class PhonesCountMapping implements \yjiotpukc\MongoODMFluent\Document\QueryResultDocument
{
    public function map(QueryResultDocument $builder): void
    {
        $builder->int('count');
    }
}
