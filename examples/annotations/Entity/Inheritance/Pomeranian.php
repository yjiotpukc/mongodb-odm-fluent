<?php

declare(strict_types=1);

namespace Examples\Entity\Inheritance;

use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;

/**
 * @Document
 */
class Pomeranian extends PedigreeDog
{
    /** @Field(type="string") */
    private string $pomeranianPrivate;
    /** @Field(type="string") */
    protected string $pomeranianProtected;
    /** @Field(type="string") */
    public string $pomeranianPublic;
}
