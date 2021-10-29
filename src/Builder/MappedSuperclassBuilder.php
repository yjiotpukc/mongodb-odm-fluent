<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Traits\CanHaveCollection;
use yjiotpukc\MongoODMFluent\Builder\Traits\CanHaveDb;
use yjiotpukc\MongoODMFluent\Builder\Traits\CanHaveDiscriminator;

class MappedSuperclassBuilder extends BaseBuilder implements FluentBuilder
{
    use CanHaveDb;
    use CanHaveCollection;
    use CanHaveDiscriminator;

    /**
     * @var int
     */
    protected $inheritanceType;

    public function build(ClassMetadata $metadata): void
    {
        $metadata->isMappedSuperclass = true;
        $this->buildDb($metadata);
        $this->buildCollection($metadata);

        if ($this->inheritanceType) {
            $metadata->setInheritanceType($this->inheritanceType);
        }

        $this->buildDiscriminator($metadata);

        parent::build($metadata);
    }

    public function singleCollection(): MappedSuperclassBuilder
    {
        $this->inheritanceType = ClassMetadata::INHERITANCE_TYPE_SINGLE_COLLECTION;

        return $this;
    }

    public function collectionPerClass(): MappedSuperclassBuilder
    {
        $this->inheritanceType = ClassMetadata::INHERITANCE_TYPE_COLLECTION_PER_CLASS;

        return $this;
    }
}
