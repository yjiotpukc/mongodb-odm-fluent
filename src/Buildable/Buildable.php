<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Buildable;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;

interface Buildable
{
    /**
     * Builds accumulated fields to ClassMetadata
     *
     * @param ClassMetadata $metadata
     */
    public function build(ClassMetadata $metadata): void;
}
