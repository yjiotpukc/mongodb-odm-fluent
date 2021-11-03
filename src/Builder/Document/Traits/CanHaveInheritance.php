<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document\Traits;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Database\Inheritance;

trait CanHaveInheritance
{
    public function singleCollection(): self
    {
        return $this->addBuilderAndReturnSelf(new Inheritance(ClassMetadata::INHERITANCE_TYPE_SINGLE_COLLECTION));
    }

    public function collectionPerClass(): self
    {
        return $this->addBuilderAndReturnSelf(new Inheritance(ClassMetadata::INHERITANCE_TYPE_COLLECTION_PER_CLASS));
    }
}
