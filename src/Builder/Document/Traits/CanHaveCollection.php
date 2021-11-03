<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document\Traits;

use yjiotpukc\MongoODMFluent\Buildable\Collection;

trait CanHaveCollection
{
    public function collection(string $name): self
    {
        return $this->addBuildableAndReturnSelf(new Collection($name));
    }
}
