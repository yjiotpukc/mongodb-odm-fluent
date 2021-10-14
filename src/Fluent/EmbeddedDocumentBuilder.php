<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Fluent;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;

class EmbeddedDocumentBuilder extends BaseBuilder implements FluentBuilder
{
    public function build(ClassMetadata $metadata): void
    {
        $metadata->isEmbeddedDocument = true;

        parent::build($metadata);
    }
}
