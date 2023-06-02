<?php

declare(strict_types=1);

namespace Examples\Entity\Id;


use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class Increment implements Document
{
    private int $id;

    public static function map(DocumentMapping $mapping): void
    {
        $mapping->id()
            ->increment()
            ->startingId(10)
            ->collection('someCollection')
            ->key('someKey');
    }

    public static function isSuperclass(): bool
    {
        return false;
    }
}
