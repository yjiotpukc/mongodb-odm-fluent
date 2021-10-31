<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Traits;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Buildable\Inheritance;

trait CanHaveInheritance
{
    public function singleCollection(): self
    {
        $this->addBuildable(new Inheritance(ClassMetadata::INHERITANCE_TYPE_SINGLE_COLLECTION));

        return $this;
    }

    public function collectionPerClass(): self
    {
        $this->addBuildable(new Inheritance(ClassMetadata::INHERITANCE_TYPE_COLLECTION_PER_CLASS));

        return $this;
    }

    abstract protected function addBuildable($buildable);
}
