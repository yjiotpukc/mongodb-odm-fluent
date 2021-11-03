<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document\Traits;

use yjiotpukc\MongoODMFluent\Builder\Database\Collection;

trait CanHaveCollection
{
    public function collection(string $name): self
    {
        return $this->addBuilderAndReturnSelf(new Collection($name));
    }
}
