<?php

declare(strict_types=1);

namespace Examples\Entity\Inheritance;

use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class Hatiko extends Akita
{
    private string $hatikoPrivate;
    protected string $hatikoProtected;
    public string $hatikoPublic;

    public static function map(DocumentMapping $mapping): void
    {
        $mapping->string('hatikoPrivate');
        $mapping->string('hatikoProtected');
        $mapping->string('hatikoPublic');
    }
}
