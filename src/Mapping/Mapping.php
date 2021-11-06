<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Mapping;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;

interface Mapping
{
    /**
     * Returns Entity name
     *
     * @return string
     */
    public function mapFor(): string;

    public function load(ClassMetadata $metadata): void;
}
