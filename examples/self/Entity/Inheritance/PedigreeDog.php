<?php

declare(strict_types=1);

namespace Examples\Entity\Inheritance;

use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class PedigreeDog extends Dog
{
    private string $pedigreeDogPrivate;
    protected string $pedigreeDogProtected;
    public string $pedigreeDogPublic;

    public static function map(DocumentMapping $mapping): void
    {
        $mapping->string('pedigreeDogPrivate');
        $mapping->string('pedigreeDogProtected');
        $mapping->string('pedigreeDogPublic');

        $mapping->discriminator('type')
            ->map('akita', Akita::class)
            ->map('pomeranian', Pomeranian::class);
    }

    public static function isSuperclass(): bool
    {
        return true;
    }
}
