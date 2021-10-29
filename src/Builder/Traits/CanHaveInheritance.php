<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Traits;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;

trait CanHaveInheritance
{
    /**
     * @var int
     */
    protected $inheritanceType;

    public function singleCollection(): self
    {
        $this->inheritanceType = ClassMetadata::INHERITANCE_TYPE_SINGLE_COLLECTION;

        return $this;
    }

    public function collectionPerClass(): self
    {
        $this->inheritanceType = ClassMetadata::INHERITANCE_TYPE_COLLECTION_PER_CLASS;

        return $this;
    }

    protected function buildInheritance(ClassMetadata $metadata)
    {
        if ($this->inheritanceType) {
            $metadata->setInheritanceType($this->inheritanceType);
        }
    }
}
