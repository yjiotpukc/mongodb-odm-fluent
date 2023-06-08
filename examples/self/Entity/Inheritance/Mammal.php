<?php

declare(strict_types=1);

namespace Examples\Entity\Inheritance;

use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class Mammal extends Animal
{
    private string $mammalPrivate;
    protected string $mammalProtected;
    public string $mammalPublic;

    public static function map(DocumentMapping $mapping): void
    {
        $mapping->mappedSuperclass();
        $mapping->collectionPerClass();

        $mapping->string('mammalPrivate');
        $mapping->string('mammalProtected');
        $mapping->string('mammalPublic');

        $mapping->discriminator('type')
            ->map('cat', Cat::class)
            ->map('dog', Dog::class);
    }
}
