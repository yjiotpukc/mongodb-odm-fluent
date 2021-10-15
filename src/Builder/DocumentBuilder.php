<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Type\Discriminator;
use yjiotpukc\MongoODMFluent\Type\Implementation\Discriminator as DiscriminatorImplementation;
use yjiotpukc\MongoODMFluent\Type\Implementation\Index as IndexImplementation;
use yjiotpukc\MongoODMFluent\Type\Index;

class DocumentBuilder extends BaseBuilder implements FluentBuilder
{
    /**
     * @var string
     */
    protected $db;

    /**
     * @var string
     */
    protected $collection;

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
     * @var Index[]
     */
    protected $indexes;

    /**
     * @var int
     */
    protected $inheritanceType;

    /**
     * @var DiscriminatorImplementation
     */
    protected $discriminator;

    public function build(ClassMetadata $metadata): void
    {
        if ($this->db) {
            $metadata->setDatabase($this->db);
        }
        if ($this->collection) {
            $metadata->setCollection($this->collection);
        }
        if ($this->repositoryClass) {
            $metadata->setCustomRepositoryClass($this->repositoryClass);
        }
        if ($this->readOnly) {
            $metadata->isReadOnly = $this->readOnly;
        }
        if ($this->writeConcern) {
            $metadata->setWriteConcern($this->writeConcern);
        }
        if ($this->indexes) {
            foreach ($this->indexes as $index) {
                $metadata->addIndex($index->keys, $index->options);
            }
        }
        if ($this->inheritanceType) {
            $metadata->setInheritanceType($this->inheritanceType);
        }
        if ($this->discriminator) {
            $metadata->setDiscriminatorField($this->discriminator->field);
            $metadata->setDiscriminatorMap($this->discriminator->map);
        }

        parent::build($metadata);
    }

    public function db(string $name): DocumentBuilder
    {
        $this->db = $name;

        return $this;
    }

    public function collection(string $name): DocumentBuilder
    {
        $this->collection = $name;

        return $this;
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

    /**
     * @param string|string[] $keys
     * @return Index
     */
    public function index($keys = []): Index
    {
        $index = new IndexImplementation($keys);
        $this->indexes[] = $index;

        return $index;
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

    public function discriminator(string $fieldName): Discriminator
    {
        $this->discriminator = new DiscriminatorImplementation($fieldName);

        return $this->discriminator;
    }
}
