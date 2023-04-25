<?php

declare(strict_types=1);

namespace Examples\Entity\Inheritance;

use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;

/**
 * @Document
 */
class Crocodile extends Reptile
{
    /** @Field(type="string") */
    private string $crocodilePrivate;
    /** @Field(type="string") */
    protected string $crocodileProtected;
    /** @Field(type="string") */
    public string $crocodilePublic;
}
