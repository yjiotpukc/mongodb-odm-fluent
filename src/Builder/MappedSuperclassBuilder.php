<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Buildable\Buildable;
use yjiotpukc\MongoODMFluent\Builder\Traits\CanHaveCollection;
use yjiotpukc\MongoODMFluent\Builder\Traits\CanHaveDb;
use yjiotpukc\MongoODMFluent\Builder\Traits\CanHaveDiscriminator;
use yjiotpukc\MongoODMFluent\Builder\Traits\CanHaveInheritance;

class MappedSuperclassBuilder extends BaseBuilder implements Buildable
{
    use CanHaveDb;
    use CanHaveCollection;
    use CanHaveInheritance;
    use CanHaveDiscriminator;

    public function build(ClassMetadata $metadata): void
    {
        $metadata->isMappedSuperclass = true;
        $this->buildCollection($metadata);
        $this->buildInheritance($metadata);
        $this->buildDiscriminator($metadata);

        parent::build($metadata);
    }
}
