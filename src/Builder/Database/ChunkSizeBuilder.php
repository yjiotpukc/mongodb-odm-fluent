<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Database;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Builder;

class ChunkSizeBuilder implements Builder
{
    protected int $bytes;

    public function __construct(int $bytes)
    {
        $this->bytes = $bytes;
    }

    public function build(ClassMetadata $metadata): void
    {
        $metadata->setChunkSizeBytes($this->bytes);
    }
}
