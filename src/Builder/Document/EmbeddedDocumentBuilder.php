<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Buildable\Buildable;
use yjiotpukc\MongoODMFluent\Builder\BaseBuilder;
use yjiotpukc\MongoODMFluent\Builder\Document\Traits\CanHaveEmbeds;
use yjiotpukc\MongoODMFluent\Builder\Document\Traits\CanHaveFields;
use yjiotpukc\MongoODMFluent\Builder\Document\Traits\CanHaveIds;
use yjiotpukc\MongoODMFluent\Builder\Document\Traits\CanHaveIndex;
use yjiotpukc\MongoODMFluent\Builder\Document\Traits\CanHaveReferences;

class EmbeddedDocumentBuilder extends BaseBuilder implements Buildable
{
    use CanHaveIds;
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
