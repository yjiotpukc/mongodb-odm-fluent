<?php

declare(strict_types=1);

namespace Examples\Entity;

use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class Misc implements Document
{
    private string $id;

    public static function map(DocumentMapping $mapping): void
    {
        $mapping->id();
        $mapping->readOnly();
        $mapping->writeConcern('majority');
        $mapping->alsoLoad('alsoLoad', ['field']);
    }

    public function alsoLoad(string $field): void
    {
    }
}
