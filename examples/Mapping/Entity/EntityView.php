<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Examples\Mapping\Entity;

use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;
use Doctrine\ODM\MongoDB\Mapping\Annotations\View;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;
use yjiotpukc\MongoODMFluent\Examples\Mapping\Repository\EntityViewRepository;

/** @View(rootClass=Entity::class, repositoryClass=EntityViewRepository::class, view="entityView") */
class EntityView
{
    /** @Field(type="string") */
    private string $stringField;

    public static function loadMetadata(ClassMetadata $classMetadata): void
    {
        $builder = new DocumentBuilder();
        $builder
            ->rootClass(Entity::class)
            ->view('entityView')
            ->repository(EntityViewRepository::class)
            ->string('stringField');
        $builder->build($classMetadata);
    }
}
