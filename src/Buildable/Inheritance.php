<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Buildable;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;

class Inheritance implements Buildable
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
