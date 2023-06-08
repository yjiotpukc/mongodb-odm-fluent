<?php

declare(strict_types=1);

namespace Examples\Entity\Inheritance;

use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class Pomeranian extends PedigreeDog
{
    private string $pomeranianPrivate;
    protected string $pomeranianProtected;
    public string $pomeranianPublic;

    public static function map(DocumentMapping $mapping): void
    {
        $mapping->string('pomeranianPrivate');
        $mapping->string('pomeranianProtected');
        $mapping->string('pomeranianPublic');
    }
}
