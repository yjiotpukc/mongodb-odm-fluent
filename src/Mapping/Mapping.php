<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Mapping;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;

interface Mapping
{
    public function load(ClassMetadata $metadata): void;
}
