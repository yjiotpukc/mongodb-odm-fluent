<?php

declare(strict_types=1);

namespace Examples\Document\Inheritance;

use Examples\Entity\Inheritance\Crocodile;
use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class ReptileDoc implements Document
{
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
