<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Mapping;

use yjiotpukc\MongoODMFluent\Mapping\Traits\EmbeddedDocumentMappingTrait;

abstract class EmbeddedDocumentMapping implements Mapping
{
    use EmbeddedDocumentMappingTrait;
}
