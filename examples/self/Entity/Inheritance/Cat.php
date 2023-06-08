<?php

declare(strict_types=1);

namespace Examples\Entity\Inheritance;

use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class Cat extends Mammal
{
    private string $catPrivate;
    protected string $catProtected;
    public string $catPublic;

    public static function map(DocumentMapping $mapping): void
    {
        $mapping->string('catPrivate');
        $mapping->string('catProtected');
        $mapping->string('catPublic');
    }
}
