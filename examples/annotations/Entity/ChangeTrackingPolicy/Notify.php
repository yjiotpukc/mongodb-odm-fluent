<?php

declare(strict_types=1);

namespace Examples\Entity\ChangeTrackingPolicy;

use Doctrine\ODM\MongoDB\Mapping\Annotations\ChangeTrackingPolicy;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;

/**
 * @Document
 * @ChangeTrackingPolicy("NOTIFY")
 */
class Notify
{
    /** @Id */
    private string $id;
}
