<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Type\Discriminator;

class MappedSuperclassBuilder extends BaseBuilder implements FluentBuilder
{
    /**
     * @var int
     */
    protected $inheritanceType;

    /**
     * @var Discriminator
     */
    protected $discriminator;

    public function build(ClassMetadata $metadata): void
    {
        $metadata->isMappedSuperclass = true;

        if ($this->inheritanceType) {
            $metadata->setInheritanceType($this->inheritanceType);
        }
        if ($this->discriminator) {
            $metadata->setDiscriminatorField($this->discriminator->field);
            $metadata->setDiscriminatorMap($this->discriminator->map);
            $metadata->setDefaultDiscriminatorValue($this->discriminator->defaultValue);
        }

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

    public function discriminator(Discriminator $discriminator): MappedSuperclassBuilder
    {
        $this->discriminator = $discriminator;

        return $this;
    }
}
