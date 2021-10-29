<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Traits\CanHaveIndex;

class EmbeddedDocumentBuilder extends BaseBuilder implements FluentBuilder
{
    use CanHaveIndex;

    public function build(ClassMetadata $metadata): void
    {
        $metadata->isEmbeddedDocument = true;
        $this->buildIndex($metadata);

        parent::build($metadata);
    }
}
