<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Fluent;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;

class MappedSuperclassBuilder extends BaseBuilder implements FluentBuilder
{
    public function build(ClassMetadata $metadata): void
    {
        $metadata->isMappedSuperclass = true;

        parent::build($metadata);
    }
}
