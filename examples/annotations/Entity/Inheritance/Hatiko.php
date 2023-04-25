<?php

declare(strict_types=1);

namespace Examples\Entity\Inheritance;

use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;

/**
 * @Document
 */
class Hatiko extends Akita
{
    /** @Field(type="string") */
    private string $hatikoPrivate;
    /** @Field(type="string") */
    protected string $hatikoProtected;
    /** @Field(type="string") */
    public string $hatikoPublic;
}
