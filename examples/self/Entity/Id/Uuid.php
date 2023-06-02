<?php

declare(strict_types=1);

namespace Examples\Entity\Id;

use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class Uuid implements Document
{
    private string $id;

    public static function map(DocumentMapping $mapping): void
    {
        $mapping->id()->uuid()->salt('secret');
    }

    public static function isSuperclass(): bool
    {
        return false;
    }
}
