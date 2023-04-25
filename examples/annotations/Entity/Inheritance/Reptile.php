<?php

declare(strict_types=1);

namespace Examples\Entity\Inheritance;

use Doctrine\ODM\MongoDB\Mapping\Annotations\DiscriminatorMap;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;
use Doctrine\ODM\MongoDB\Mapping\Annotations\MappedSuperclass;

/**
 * @MappedSuperclass
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
}
