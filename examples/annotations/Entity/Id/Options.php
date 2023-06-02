<?php

declare(strict_types=1);

namespace Examples\Entity\Id;

use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;

/**
 * @Document
 */
class Options
{
    /**
     * @Id(notSaved=true, nullable=true)
     */
    private string $myId;
}
