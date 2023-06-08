<?php

declare(strict_types=1);

namespace Examples\Document\ChangeTrackingPolicy;

use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class DeferredExplicitDoc implements Document
{
    public static function map(DocumentMapping $mapping): void
    {
        $mapping->id();
        $mapping->changeTrackingPolicy()->deferredExplicit();
    }
}
