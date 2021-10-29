<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Traits\CanHaveDiscriminator;

class MappedSuperclassBuilder extends BaseBuilder implements FluentBuilder
{
    use CanHaveDiscriminator;

    /**
     * @var string
     */
    protected $db;

    /**
     * @var string
     */
    protected $collection;

    /**
     * @var int
     */
    protected $inheritanceType;

    public function build(ClassMetadata $metadata): void
    {
        $metadata->isMappedSuperclass = true;

        if ($this->db) {
            $metadata->setDatabase($this->db);
        }
        if ($this->collection) {
            $metadata->setCollection($this->collection);
        }
        if ($this->inheritanceType) {
            $metadata->setInheritanceType($this->inheritanceType);
        }

        $this->buildDiscriminator($metadata);

        parent::build($metadata);
    }

    public function db(string $name): MappedSuperclassBuilder
    {
        $this->db = $name;

        return $this;
    }

    public function collection(string $name): MappedSuperclassBuilder
    {
        $this->collection = $name;

        return $this;
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
