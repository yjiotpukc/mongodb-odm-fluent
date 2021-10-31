<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Buildable;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;

class RepositoryClass implements Buildable
{
    /**
     * @var string
     */
    protected $className;

    public function __construct(string $className)
    {
        $this->className = $className;
    }

    public function build(ClassMetadata $metadata): void
    {
        $metadata->setCustomRepositoryClass($this->className);
    }
}
