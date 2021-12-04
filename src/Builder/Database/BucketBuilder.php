<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Database;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Builder;

class BucketBuilder implements Builder
{
    protected string $bucketName;

    public function __construct(string $name)
    {
        $this->bucketName = $name;
    }

    public function build(ClassMetadata $metadata): void
    {
        $metadata->setBucketName($this->bucketName);
    }
}
