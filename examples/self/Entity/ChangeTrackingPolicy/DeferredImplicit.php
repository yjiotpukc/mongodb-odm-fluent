<?php

declare(strict_types=1);

namespace Examples\Entity\ChangeTrackingPolicy;

use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class DeferredImplicit implements Document
{
    private string $id;

    public static function map(DocumentMapping $mapping): void
    {
        $mapping->id();
        $mapping->changeTrackingPolicy()->deferredImplicit();
    }

    public static function isSuperclass(): bool
    {
        return false;
    }
}