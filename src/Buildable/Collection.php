<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Buildable;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;

class Collection implements Buildable
{
    /**
     * @var string
     */
    protected $collectionName;

    public function __construct(string $collectionName)
    {
        $this->collectionName = $collectionName;
    }

    public function build(ClassMetadata $metadata): void
    {
        $metadata->setCollection($this->collectionName);
    }
}
