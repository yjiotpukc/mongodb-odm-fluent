<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Fluent;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Types\Discriminator;

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

    public function discriminator(string $fieldName): Discriminator
    {
        $this->discriminator = new Discriminator($fieldName);

        return $this->discriminator;
    }
}
