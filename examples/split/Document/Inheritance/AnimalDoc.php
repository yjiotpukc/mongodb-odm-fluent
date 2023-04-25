<?php

declare(strict_types=1);

namespace Examples\Document\Inheritance;

use Examples\Entity\Inheritance\Mammal;
use Examples\Entity\Inheritance\Reptile;
use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class AnimalDoc implements Document
{
    public static function map(DocumentMapping $mapping): void
    {
        $mapping->singleCollection();

        $mapping->id();
        $mapping->string('animalPrivate');
        $mapping->string('animalProtected');
        $mapping->string('animalPublic');

        $mapping->discriminator('type')
            ->map('mammal', Mammal::class)
            ->map('reptile', Reptile::class);
    }

    public static function isSuperclass(): bool
    {
        return true;
    }
}
