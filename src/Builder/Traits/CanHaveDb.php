<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Traits;

use yjiotpukc\MongoODMFluent\Buildable\Db;

trait CanHaveDb
{
    use AbstractBuilderTrait;

    public function db(string $name): self
    {
        $this->addBuildable(new Db($name));

        return $this;
    }
}
