<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document\Traits;

use yjiotpukc\MongoODMFluent\Builder\Database\RepositoryClass;

trait CanHaveRepository
{
    public function repository(string $className): self
    {
        return $this->addBuilderAndReturnSelf(new RepositoryClass($className));
    }
}
