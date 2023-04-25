<?php

declare(strict_types=1);

namespace Examples\Repository;

use Doctrine\ODM\MongoDB\Aggregation\Builder;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;
use Doctrine\ODM\MongoDB\Repository\ViewRepository;

class EntityViewRepository extends DocumentRepository implements ViewRepository
{
    public function createViewAggregation(Builder $builder): void
    {
        $builder->project()->includeFields(['stringField']);
    }
}
