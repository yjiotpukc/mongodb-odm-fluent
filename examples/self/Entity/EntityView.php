<?php

declare(strict_types=1);

namespace Examples\Entity;

use yjiotpukc\MongoODMFluent\Document\View;
use yjiotpukc\MongoODMFluent\Mapping\ViewMapping;
use Examples\Repository\EntityViewRepository;

class EntityView implements View
{
    private string $stringField;

    public static function map(ViewMapping $mapping): void
    {
        $mapping
            ->rootClass(Entity::class)
            ->view('entityView')
            ->repository(EntityViewRepository::class)
            ->string('stringField');
    }
}
