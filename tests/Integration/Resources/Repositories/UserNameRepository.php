<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Repositories;

use Doctrine\ODM\MongoDB\Aggregation\Builder;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;
use Doctrine\ODM\MongoDB\Repository\ViewRepository;

class UserNameRepository extends DocumentRepository implements ViewRepository
{
    public function createViewAggregation(Builder $builder): void
    {
        $builder->project()->includeFields(['name']);
    }
}
