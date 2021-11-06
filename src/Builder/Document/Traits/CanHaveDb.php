<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document\Traits;

use yjiotpukc\MongoODMFluent\Builder\Database\DbBuilder;

trait CanHaveDb
{
    public function db(string $name): self
    {
        return $this->addBuilderAndReturnSelf(new DbBuilder($name));
    }
}
