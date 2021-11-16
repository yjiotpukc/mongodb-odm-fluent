<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document\Traits;

use yjiotpukc\MongoODMFluent\Builder\Database\CollectionBuilder;
use yjiotpukc\MongoODMFluent\Type\Collection;

trait CanHaveCollection
{
    public function collection(string $name): Collection
    {
        return $this->addBuilder(new CollectionBuilder($name));
    }
}
