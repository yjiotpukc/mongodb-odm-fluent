<?php

declare(strict_types=1);

namespace Examples\Document\ReadPreference;

use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class PrimaryPreferredDoc implements Document
{
    public static function map(DocumentMapping $mapping): void
    {
        $mapping->id();
        $mapping->readPreference()->primaryPreferred();
    }
}
