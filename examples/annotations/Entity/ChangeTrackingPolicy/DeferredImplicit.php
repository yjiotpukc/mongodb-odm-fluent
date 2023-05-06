<?php

declare(strict_types=1);

namespace Examples\Entity\ChangeTrackingPolicy;

use Doctrine\ODM\MongoDB\Mapping\Annotations\ChangeTrackingPolicy;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;

/**
 * @Document
 * @ChangeTrackingPolicy("DEFERRED_IMPLICIT")
 */
class DeferredImplicit
{
    /** @Id */
    private string $id;
}
