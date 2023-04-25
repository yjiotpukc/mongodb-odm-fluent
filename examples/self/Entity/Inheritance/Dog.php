<?php

declare(strict_types=1);

namespace Examples\Entity\Inheritance;

use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class Dog extends Mammal
{
    private string $dogPrivate;
    protected string $dogProtected;
    public string $dogPublic;

    public static function map(DocumentMapping $mapping): void
    {
        $mapping->string('dogPrivate');
        $mapping->string('dogProtected');
        $mapping->string('dogPublic');
    }

    public static function isSuperclass(): bool
    {
        return false;
    }
}
