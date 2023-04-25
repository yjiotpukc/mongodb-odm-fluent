<?php

declare(strict_types=1);

namespace Examples\Document;

use Examples\Entity\Entity;
use yjiotpukc\MongoODMFluent\Document\View;
use yjiotpukc\MongoODMFluent\Mapping\ViewMapping;
use Examples\Repository\EntityViewRepository;

class EntityViewDoc implements View
{
    public static function map(ViewMapping $mapping): void
    {
        $mapping
            ->rootClass(Entity::class)
            ->view('entityView')
            ->repository(EntityViewRepository::class)
            ->string('stringField');
    }
}
