<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document\Traits;

use yjiotpukc\MongoODMFluent\Builder\Database\InheritanceBuilder;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;

trait CanHaveInheritance
{
    public function singleCollection(): DocumentBuilder
    {
        return $this->addBuilderAndReturnSelf(InheritanceBuilder::singleCollection());
    }

    public function collectionPerClass(): DocumentBuilder
    {
        return $this->addBuilderAndReturnSelf(InheritanceBuilder::collectionPerClass());
    }
}
