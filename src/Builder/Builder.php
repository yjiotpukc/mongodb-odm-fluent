<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;

interface Builder
{
    /**
     * Builds accumulated fields to ClassMetadata
     *
     * @param ClassMetadata $metadata
     */
    public function build(ClassMetadata $metadata): void;
}
