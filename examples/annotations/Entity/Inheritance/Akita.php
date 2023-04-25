<?php

declare(strict_types=1);

namespace Examples\Entity\Inheritance;

use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;

/**
 * @Document
 */
class Akita extends PedigreeDog
{
    /** @Field(type="string") */
    private string $akitaPrivate;
    /** @Field(type="string") */
    protected string $akitaProtected;
    /** @Field(type="string") */
    public string $akitaPublic;
}
