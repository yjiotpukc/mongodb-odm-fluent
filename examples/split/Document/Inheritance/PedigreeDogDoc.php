<?php

declare(strict_types=1);

namespace Examples\Document\Inheritance;

use Examples\Entity\Inheritance\Akita;
use Examples\Entity\Inheritance\Pomeranian;
use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class PedigreeDogDoc implements Document
{
    public static function map(DocumentMapping $mapping): void
    {
        $mapping->mappedSuperclass();

        $mapping->string('pedigreeDogPrivate');
        $mapping->string('pedigreeDogProtected');
        $mapping->string('pedigreeDogPublic');

        $mapping->discriminator('type')
            ->map('akita', Akita::class)
            ->map('pomeranian', Pomeranian::class);
    }
}
