<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\SomeNamespace;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Mapping\Mapping;

class EntityStubMapping implements Mapping
{
    public function load(ClassMetadata $metadata): void
    {
    }
}
