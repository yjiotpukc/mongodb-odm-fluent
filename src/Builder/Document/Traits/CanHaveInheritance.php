<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document\Traits;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Buildable\Inheritance;

trait CanHaveInheritance
{
    public function singleCollection(): self
    {
        return $this->addBuildableAndReturnSelf(new Inheritance(ClassMetadata::INHERITANCE_TYPE_SINGLE_COLLECTION));
    }

    public function collectionPerClass(): self
    {
        return $this->addBuildableAndReturnSelf(new Inheritance(ClassMetadata::INHERITANCE_TYPE_COLLECTION_PER_CLASS));
    }
}
