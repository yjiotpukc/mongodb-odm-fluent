<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Buildable\Buildable;
use yjiotpukc\MongoODMFluent\Builder\BaseBuilder;
use yjiotpukc\MongoODMFluent\Builder\Document\Traits\CanHaveCollection;
use yjiotpukc\MongoODMFluent\Builder\Document\Traits\CanHaveDb;
use yjiotpukc\MongoODMFluent\Builder\Document\Traits\CanHaveDiscriminator;
use yjiotpukc\MongoODMFluent\Builder\Document\Traits\CanHaveEmbeds;
use yjiotpukc\MongoODMFluent\Builder\Document\Traits\CanHaveFields;
use yjiotpukc\MongoODMFluent\Builder\Document\Traits\CanHaveIds;
use yjiotpukc\MongoODMFluent\Builder\Document\Traits\CanHaveInheritance;
use yjiotpukc\MongoODMFluent\Builder\Document\Traits\CanHaveReferences;

class MappedSuperclassBuilder extends BaseBuilder implements Buildable
{
    use CanHaveDb;
    use CanHaveCollection;
    use CanHaveIds;
    use CanHaveFields;
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
