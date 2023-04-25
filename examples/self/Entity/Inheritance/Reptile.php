<?php

declare(strict_types=1);

namespace Examples\Entity\Inheritance;

use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class Reptile extends Animal
{
    private string $reptilePrivate;
    protected string $reptileProtected;
    public string $reptilePublic;

    public static function map(DocumentMapping $mapping): void
    {
        $mapping->string('reptilePrivate');
        $mapping->string('reptileProtected');
        $mapping->string('reptilePublic');

        $mapping->discriminator('type')
            ->map('crocodile', Crocodile::class);
    }

    public static function isSuperclass(): bool
    {
        return true;
    }
}
