<?php

declare(strict_types=1);

namespace Examples\Entity\Inheritance;

use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class Akita extends PedigreeDog
{
    private string $akitaPrivate;
    protected string $akitaProtected;
    public string $akitaPublic;

    public static function map(DocumentMapping $mapping): void
    {
        $mapping->string('akitaPrivate');
        $mapping->string('akitaProtected');
        $mapping->string('akitaPublic');
    }
}
