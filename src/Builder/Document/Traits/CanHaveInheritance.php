<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document\Traits;

use yjiotpukc\MongoODMFluent\Builder\Database\InheritanceBuilder;

trait CanHaveInheritance
{
    public function singleCollection(): self
    {
        return $this->addBuilderAndReturnSelf(InheritanceBuilder::singleCollection());
    }

    public function collectionPerClass(): self
    {
        return $this->addBuilderAndReturnSelf(InheritanceBuilder::collectionPerClass());
    }
}
