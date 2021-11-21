<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Database;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Builder;

class RootClassBuilder implements Builder
{
    protected string $rootClass;

    public function __construct(string $className)
    {
        $this->rootClass = $className;
    }

    public function build(ClassMetadata $metadata): void
    {
        $metadata->markViewOf($this->rootClass);
    }
}
