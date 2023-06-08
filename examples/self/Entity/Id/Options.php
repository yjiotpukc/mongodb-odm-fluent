<?php

declare(strict_types=1);

namespace Examples\Entity\Id;

use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class Options implements Document
{
    private string $myId;

    public static function map(DocumentMapping $mapping): void
    {
        $mapping->id()
            ->fieldName('myId')
            ->nullable()
            ->notSaved();
    }
}
