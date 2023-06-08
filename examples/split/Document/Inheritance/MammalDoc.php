<?php

declare(strict_types=1);

namespace Examples\Document\Inheritance;

use Examples\Entity\Inheritance\Cat;
use Examples\Entity\Inheritance\Dog;
use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class MammalDoc implements Document
{
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
