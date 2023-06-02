<?php

declare(strict_types=1);

namespace Examples\Entity;

use Doctrine\ODM\MongoDB\Mapping\Annotations\EmbeddedDocument;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;

/** @EmbeddedDocument */
class Embedded
{
    /** @Field(type="float") */
    private float $latitude;
    /** @Field(type="float") */
    private float $longitude;
}
