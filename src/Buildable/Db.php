<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Buildable;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;

class Db implements Buildable
{
    /**
     * @var string
     */
    protected $dbName;

    public function __construct(string $dbName)
    {
        $this->dbName = $dbName;
    }

    public function build(ClassMetadata $metadata): void
    {
        $metadata->setDatabase($this->dbName);
    }
}
