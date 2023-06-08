<?php

declare(strict_types=1);

namespace Examples\Entity\Inheritance;

use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class Animal implements Document
{
    protected string $id;
    private string $animalPrivate;
    protected string $animalProtected;
    public string $animalPublic;

    public static function map(DocumentMapping $mapping): void
    {
        $mapping->mappedSuperclass();
        $mapping->singleCollection();

        $mapping->id();
        $mapping->string('animalPrivate');
        $mapping->string('animalProtected');
        $mapping->string('animalPublic');

        $mapping->discriminator('type')
            ->map('mammal', Mammal::class)
            ->map('reptile', Reptile::class);
    }
}
