<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Loader;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;

interface ClassMetadataLoader
{
    public function load(string $mapping, ClassMetadata $metadata): void;
}
