<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Traits;

use yjiotpukc\MongoODMFluent\Buildable\Collection;

trait CanHaveCollection
{
    use AbstractBuilderTrait;

    public function collection(string $name): self
    {
        $this->addBuildable(new Collection($name));

        return $this;
    }
}
