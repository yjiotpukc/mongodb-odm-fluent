<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Examples\Mapping\Entity\Inheritance;

use Doctrine\ODM\MongoDB\Mapping\Annotations\DiscriminatorField;
use Doctrine\ODM\MongoDB\Mapping\Annotations\DiscriminatorMap;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;
use Doctrine\ODM\MongoDB\Mapping\Annotations\MappedSuperclass;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;

/**
 * @MappedSuperclass
 * @DiscriminatorField("type")
 * @DiscriminatorMap({"crocodile"=Crocodile::class})
 */
class Reptile extends Animal
{
    /** @Field(type="string") */
    private string $reptilePrivate;
    /** @Field(type="string") */
    protected string $reptileProtected;
    /** @Field(type="string") */
    public string $reptilePublic;

    public static function loadMetadata(ClassMetadata $classMetadata): void
    {
        $builder = new DocumentBuilder();
        $builder->mappedSuperclass();
        $builder
            ->discriminator('type')
            ->map('crocodile', Crocodile::class);
        $builder->string('reptilePrivate');
        $builder->string('reptileProtected');
        $builder->string('reptilePublic');
        $builder->build($classMetadata);
    }
}
