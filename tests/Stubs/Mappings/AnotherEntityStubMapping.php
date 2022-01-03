<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Mapping\Mapping;

class AnotherEntityStubMapping implements Mapping
{
    public function load(ClassMetadata $metadata): void
    {
    }
}
