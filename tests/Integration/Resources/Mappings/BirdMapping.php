<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Mappings;

use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class BirdMapping implements Document
{
    public static function map(DocumentMapping $mapping): void
    {
        $mapping->field('boolean', 'isTalking');
    }
}
