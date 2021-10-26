<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Mapping\Mapping;

class AnotherMappingStub implements Mapping
{
    public function mapFor(): string
    {
        return AnotherEntityStub::class;
    }

    public function load(ClassMetadata $metadata): void
    {
    }
}
