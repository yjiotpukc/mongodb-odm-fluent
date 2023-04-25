<?php

declare(strict_types=1);

namespace Examples\Entity\Inheritance;

use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;

/**
 * @Document
 */
class Cat extends Mammal
{
    /** @Field(type="string") */
    private string $catPrivate;
    /** @Field(type="string") */
    protected string $catProtected;
    /** @Field(type="string") */
    public string $catPublic;
}
