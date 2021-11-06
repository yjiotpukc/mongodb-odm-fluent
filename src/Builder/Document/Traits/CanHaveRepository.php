<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document\Traits;

use yjiotpukc\MongoODMFluent\Builder\Database\RepositoryClassBuilder;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;

trait CanHaveRepository
{
    public function repository(string $className): DocumentBuilder
    {
        return $this->addBuilderAndReturnSelf(new RepositoryClassBuilder($className));
    }
}
