<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Database;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Builder;

class Inheritance implements Builder
{
    /**
     * @var int
     */
    protected $type;

    public function __construct(int $type)
    {
        $this->type = $type;
    }

    public function build(ClassMetadata $metadata): void
    {
        $metadata->setInheritanceType($this->type);
    }
}
