<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Traits;

use yjiotpukc\MongoODMFluent\Buildable\RepositoryClass;

trait CanHaveRepository
{
    use AbstractBuilderTrait;

    public function repository(string $className): self
    {
        $this->addBuildable(new RepositoryClass($className));

        return $this;
    }
}
