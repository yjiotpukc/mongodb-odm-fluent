<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Buildable;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;

class WriteConcern implements Buildable
{
    /**
     * @var int|string|null
     */
    protected $writeConcern;

    /**
     * @param int|string|null $writeConcern
     */
    public function __construct($writeConcern)
    {
        $this->writeConcern = $writeConcern;
    }

    public function build(ClassMetadata $metadata): void
    {
        $metadata->setWriteConcern($this->writeConcern);
    }
}
