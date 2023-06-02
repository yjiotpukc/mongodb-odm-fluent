<?php

declare(strict_types=1);

namespace Examples\Entity\Id;

use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class AlNum implements Document
{
    private string $id;

    public static function map(DocumentMapping $mapping): void
    {
        $mapping->id()
            ->alNum()
            ->awkwardSafeMode()
            ->pad(5)
            ->chars('abcdefg');
    }

    public static function isSuperclass(): bool
    {
        return false;
    }
}
