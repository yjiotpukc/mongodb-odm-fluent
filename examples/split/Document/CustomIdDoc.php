<?php

declare(strict_types=1);

namespace Examples\Document;

use Examples\IdGenerator\CustomIdGenerator;
use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class CustomIdDoc implements Document
{
    public static function map(DocumentMapping $mapping): void
    {
        $mapping->id()
            ->custom(CustomIdGenerator::class)
            ->type('string')
            ->generatorOption('prefix', 'pre-')
            ->generatorOption('postfix', '-post');
    }

    public static function isSuperclass(): bool
    {
        return false;
    }
}
