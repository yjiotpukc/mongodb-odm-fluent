<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Buildable\Buildable;
use yjiotpukc\MongoODMFluent\Builder\Traits\CanHaveCollection;
use yjiotpukc\MongoODMFluent\Builder\Traits\CanHaveDb;
use yjiotpukc\MongoODMFluent\Builder\Traits\CanHaveDiscriminator;
use yjiotpukc\MongoODMFluent\Builder\Traits\CanHaveEmbeds;
use yjiotpukc\MongoODMFluent\Builder\Traits\CanHaveInheritance;
use yjiotpukc\MongoODMFluent\Builder\Traits\CanHaveReferences;

class MappedSuperclassBuilder extends BaseBuilder implements Buildable
{
    use CanHaveDb;
    use CanHaveCollection;
    use CanHaveReferences;
    use CanHaveEmbeds;
    use CanHaveInheritance;
    use CanHaveDiscriminator;

    public function build(ClassMetadata $metadata): void
    {
        $metadata->isMappedSuperclass = true;
        parent::build($metadata);
    }
}
