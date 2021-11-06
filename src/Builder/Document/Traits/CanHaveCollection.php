<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document\Traits;

use yjiotpukc\MongoODMFluent\Builder\Database\CollectionBuilder;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;

trait CanHaveCollection
{
    public function collection(string $name): DocumentBuilder
    {
        return $this->addBuilderAndReturnSelf(new CollectionBuilder($name));
    }
}
