<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Database;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Builder;

class CollectionBuilder implements Builder
{
    protected string $collectionName;

    public function __construct(string $collectionName)
    {
        $this->collectionName = $collectionName;
    }

    public function build(ClassMetadata $metadata): void
    {
        $metadata->setCollection($this->collectionName);
    }
}
