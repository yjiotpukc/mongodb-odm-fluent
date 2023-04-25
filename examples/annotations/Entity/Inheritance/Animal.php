<?php

declare(strict_types=1);

namespace Examples\Entity\Inheritance;

use Doctrine\ODM\MongoDB\Mapping\Annotations\DiscriminatorField;
use Doctrine\ODM\MongoDB\Mapping\Annotations\DiscriminatorMap;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use Doctrine\ODM\MongoDB\Mapping\Annotations\InheritanceType;
use Doctrine\ODM\MongoDB\Mapping\Annotations\MappedSuperclass;

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
}
