<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Examples\Mapping\Entity\Inheritance;

use Doctrine\ODM\MongoDB\Mapping\Annotations\DiscriminatorField;
use Doctrine\ODM\MongoDB\Mapping\Annotations\DiscriminatorMap;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use Doctrine\ODM\MongoDB\Mapping\Annotations\InheritanceType;
use Doctrine\ODM\MongoDB\Mapping\Annotations\MappedSuperclass;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;
use yjiotpukc\MongoODMFluent\Examples\Mapping\Entity\Embedded;

/**
 * @MappedSuperclass
 * @InheritanceType("SINGLE_COLLECTION")
 * @DiscriminatorField("type")
 * @DiscriminatorMap({"mammal"=Mammal::class, "reptile"=Reptile::class})
 */
class Animal
{
    /** @Id */
    protected string $id;

    /** @Field(type="string") */
    private string $animalPrivate;
    /** @Field(type="string") */
    protected string $animalProtected;
    /** @Field(type="string") */
    public string $animalPublic;

    public static function loadMetadata(ClassMetadata $classMetadata): void
    {
        $builder = new DocumentBuilder();
        $builder->mappedSuperclass();
        $builder
            ->discriminator('type')
            ->map('mammal', Mammal::class)
            ->map('reptile', Reptile::class);
        $builder->singleCollection();
        $builder->id();
        $builder->string('animalPrivate');
        $builder->string('animalProtected');
        $builder->string('animalPublic');
        $builder->build($classMetadata);
    }
}
