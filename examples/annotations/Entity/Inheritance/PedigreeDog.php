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
 * @DiscriminatorMap({"akita"=Akita::class, "pomeranian"=Pomeranian::class})
 */
class PedigreeDog extends Dog
{
    /** @Field(type="string") */
    private string $pedigreeDogPrivate;
    /** @Field(type="string") */
    protected string $pedigreeDogProtected;
    /** @Field(type="string") */
    public string $pedigreeDogPublic;
}
