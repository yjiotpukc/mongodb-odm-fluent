<?php

declare(strict_types=1);

namespace Examples\Entity\Inheritance;

use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;

/**
 * @Document
 */
class Dog extends Mammal
{
    /** @Field(type="string") */
    private string $dogPrivate;
    /** @Field(type="string") */
    protected string $dogProtected;
    /** @Field(type="string") */
    public string $dogPublic;
}
