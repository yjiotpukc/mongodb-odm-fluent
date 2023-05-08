<?php

declare(strict_types=1);

namespace Examples\Entity\Id;

use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;

/**
 * @Document
 */
class None
{
    /**
     * @Id(strategy="none")
     */
    private string $id;
}
