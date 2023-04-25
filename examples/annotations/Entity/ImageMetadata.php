<?php

declare(strict_types=1);

namespace Examples\Entity;

use Doctrine\ODM\MongoDB\Mapping\Annotations\EmbeddedDocument;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;

/** @EmbeddedDocument */
class ImageMetadata
{
    /** @Field(type="string") */
    protected string $uploadedBy;
}
