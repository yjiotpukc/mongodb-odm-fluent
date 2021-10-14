<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Fluent;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;

interface FluentBuilder
{
    /**
     * Builds accumulated fields to ClassMetadata
     *
     * @param ClassMetadata $metadata
     */
    public function build(ClassMetadata $metadata): void;
}
