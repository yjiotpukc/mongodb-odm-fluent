<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document\Traits;

use yjiotpukc\MongoODMFluent\Buildable\RepositoryClass;

trait CanHaveRepository
{
    public function repository(string $className): self
    {
        return $this->addBuildableAndReturnSelf(new RepositoryClass($className));
    }
}
