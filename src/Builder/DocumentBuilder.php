<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Traits\CanHaveCollection;
use yjiotpukc\MongoODMFluent\Builder\Traits\CanHaveDb;
use yjiotpukc\MongoODMFluent\Builder\Traits\CanHaveDiscriminator;
use yjiotpukc\MongoODMFluent\Builder\Traits\CanHaveIndex;

class DocumentBuilder extends BaseBuilder implements FluentBuilder
{
    use CanHaveDb;
    use CanHaveCollection;
    use CanHaveIndex;
    use CanHaveDiscriminator;

    /**
     * @var string
     */
    protected $repositoryClass;

    /**
     * @var bool
     */
    protected $readOnly;

    /**
     * @var string|int|null
     */
    protected $writeConcern;

    /**
     * @var int
     */
    protected $inheritanceType;

    public function build(ClassMetadata $metadata): void
    {
        $this->buildDb($metadata);
        $this->buildCollection($metadata);
        if ($this->repositoryClass) {
            $metadata->setCustomRepositoryClass($this->repositoryClass);
        }
        if ($this->readOnly) {
            $metadata->isReadOnly = $this->readOnly;
        }
        if ($this->writeConcern) {
            $metadata->setWriteConcern($this->writeConcern);
        }
        if ($this->inheritanceType) {
            $metadata->setInheritanceType($this->inheritanceType);
        }

        $this->buildIndex($metadata);
        $this->buildDiscriminator($metadata);

        parent::build($metadata);
    }

    public function repository(string $className): DocumentBuilder
    {
        $this->repositoryClass = $className;

        return $this;
    }

    public function readOnly(): DocumentBuilder
    {
        $this->readOnly = true;

        return $this;
    }

    /**
     * @param string|int|null $writeConcern
     */
    public function writeConcern($writeConcern): DocumentBuilder
    {
        $this->writeConcern = $writeConcern;

        return $this;
    }

    public function singleCollection(): DocumentBuilder
    {
        $this->inheritanceType = ClassMetadata::INHERITANCE_TYPE_SINGLE_COLLECTION;

        return $this;
    }

    public function collectionPerClass(): DocumentBuilder
    {
        $this->inheritanceType = ClassMetadata::INHERITANCE_TYPE_COLLECTION_PER_CLASS;

        return $this;
    }
}
