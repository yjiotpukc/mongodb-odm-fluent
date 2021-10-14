<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Fluent;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;

abstract class BaseBuilder implements FluentBuilder
{
    public function build(ClassMetadata $metadata): void
    {
    }
}
