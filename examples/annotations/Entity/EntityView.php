<?php

declare(strict_types=1);

namespace Examples\Entity;

use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;
use Doctrine\ODM\MongoDB\Mapping\Annotations\View;
use Examples\Repository\EntityViewRepository;

/** @View(rootClass=Entity::class, repositoryClass=EntityViewRepository::class, view="entityView") */
class EntityView
{
    /** @Field(type="string") */
    private string $stringField;
}
