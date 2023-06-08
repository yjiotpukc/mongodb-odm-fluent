<?php

declare(strict_types=1);

namespace Examples\Document\Id;

use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class IncrementDoc implements Document
{
    public static function map(DocumentMapping $mapping): void
    {
        $mapping->id()
            ->increment()
            ->startingId(10)
            ->collection('someCollection')
            ->key('someKey');
    }
}
