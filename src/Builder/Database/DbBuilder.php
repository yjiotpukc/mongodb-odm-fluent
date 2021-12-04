<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Database;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Builder;

class DbBuilder implements Builder
{
    protected string $dbName;

    public function __construct(string $dbName)
    {
        $this->dbName = $dbName;
    }

    public function build(ClassMetadata $metadata): void
    {
        $metadata->setDatabase($this->dbName);
    }
}
