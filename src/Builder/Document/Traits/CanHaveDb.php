<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document\Traits;

use yjiotpukc\MongoODMFluent\Buildable\Db;

trait CanHaveDb
{
    public function db(string $name): self
    {
        return $this->addBuildableAndReturnSelf(new Db($name));
    }
}
