<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Fluent;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Types\Index;

class DocumentBuilder extends BaseBuilder implements FluentBuilder
{
    protected $db;
    protected $collection;
    protected $repositoryClass;
    protected $readOnly;
    protected $writeConcern;
    protected $indexes;

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
                $metadata->addIndex($index->keys, $index->options());
            }
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
        $index = new Index($keys);
        $this->indexes[] = $index;

        return $index;
    }
}
