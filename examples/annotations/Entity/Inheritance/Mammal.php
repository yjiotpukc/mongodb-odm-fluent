<?php

declare(strict_types=1);

namespace Examples\Entity\Inheritance;

use Doctrine\ODM\MongoDB\Mapping\Annotations\DiscriminatorField;
use Doctrine\ODM\MongoDB\Mapping\Annotations\DiscriminatorMap;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;
use Doctrine\ODM\MongoDB\Mapping\Annotations\MappedSuperclass;

/**
 * @MappedSuperclass
 * @DiscriminatorField("type")
 * @DiscriminatorMap({"cat"=Cat::class, "dog"=Dog::class})
 */
class Mammal extends Animal
{
    /** @Field(type="string") */
    private string $mammalPrivate;
    /** @Field(type="string") */
    protected string $mammalProtected;
    /** @Field(type="string") */
    public string $mammalPublic;
}
