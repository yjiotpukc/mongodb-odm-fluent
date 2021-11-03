<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document\Traits;

use yjiotpukc\MongoODMFluent\Builder\Database\Inheritance;

trait CanHaveInheritance
{
    public function singleCollection(): self
    {
        return $this->addBuilderAndReturnSelf(Inheritance::singleCollection());
    }

    public function collectionPerClass(): self
    {
        return $this->addBuilderAndReturnSelf(Inheritance::collectionPerClass());
    }
}
