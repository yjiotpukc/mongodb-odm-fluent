<?php

declare(strict_types=1);

namespace Examples\Entity\ReadPreference;

use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use Doctrine\ODM\MongoDB\Mapping\Annotations\ReadPreference;

/**
 * @Document
 * @ReadPreference(
 *     "secondary",
 *     tags={
 *         { "dc"="east" },
 *         { "dc"="west" },
 *         {  }
 *     }
 * )
 */
class Secondary
{
    /** @Id */
    private string $id;
}