<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Database;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Builder;

class RepositoryClassBuilder implements Builder
{
    protected string $className;

    public function __construct(string $className)
    {
        $this->className = $className;
    }

    public function build(ClassMetadata $metadata): void
    {
        $metadata->setCustomRepositoryClass($this->className);
    }
}
