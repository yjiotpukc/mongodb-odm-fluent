<?php

declare(strict_types=1);

namespace Examples\Entity\Id;

use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;

/**
 * @Document
 */
class Uuid
{
    /**
     * @Id(
     *     strategy="uuid",
     *     options={
     *         "salt"="secret"
     *     }
     * )
     */
    private string $id;
}
