<?php

declare(strict_types=1);

namespace Examples\Entity\Inheritance;

use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class Crocodile extends Reptile
{
    private string $crocodilePrivate;
    protected string $crocodileProtected;
    public string $crocodilePublic;

    public static function map(DocumentMapping $mapping): void
    {
        $mapping->id();
        $mapping->string('crocodilePrivate');
        $mapping->string('crocodileProtected');
        $mapping->string('crocodilePublic');
    }
}
