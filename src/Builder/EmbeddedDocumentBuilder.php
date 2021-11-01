<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Buildable\Buildable;
use yjiotpukc\MongoODMFluent\Builder\Traits\CanHaveEmbeds;
use yjiotpukc\MongoODMFluent\Builder\Traits\CanHaveFields;
use yjiotpukc\MongoODMFluent\Builder\Traits\CanHaveIndex;
use yjiotpukc\MongoODMFluent\Builder\Traits\CanHaveReferences;

class EmbeddedDocumentBuilder extends BaseBuilder implements Buildable
{
    use CanHaveFields;
    use CanHaveReferences;
    use CanHaveEmbeds;
    use CanHaveIndex;

    public function build(ClassMetadata $metadata): void
    {
        $metadata->isEmbeddedDocument = true;
        parent::build($metadata);
    }
}
