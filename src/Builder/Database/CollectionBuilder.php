<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Database;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Builder;
use yjiotpukc\MongoODMFluent\Type\Collection;

class CollectionBuilder implements Builder, Collection
{
    protected string $collectionName;
    protected ?int $size = null;
    protected ?int $max = null;

    public function __construct(string $collectionName)
    {
        $this->collectionName = $collectionName;
    }

    public function cappedAt(int $size, int $max = null): Collection
    {
        $this->size = $size;
        $this->max = $max;

        return $this;
    }

    public function build(ClassMetadata $metadata): void
    {
        $metadata->setCollection($this->collectionName);
        if ($this->size) {
            $metadata->setCollectionCapped(true);
            $metadata->setCollectionSize($this->size);
            if ($this->max) {
                $metadata->setCollectionMax($this->max);
            }
        }
    }
}
