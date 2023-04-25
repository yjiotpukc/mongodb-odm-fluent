<?php

declare(strict_types=1);

namespace Examples\Entity;

use Doctrine\ODM\MongoDB\Event\LifecycleEventArgs;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\HasLifecycleCallbacks;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use Doctrine\ODM\MongoDB\Mapping\Annotations\PostLoad;
use Doctrine\ODM\MongoDB\Mapping\Annotations\PostPersist;
use Doctrine\ODM\MongoDB\Mapping\Annotations\PostRemove;
use Doctrine\ODM\MongoDB\Mapping\Annotations\PostUpdate;
use Doctrine\ODM\MongoDB\Mapping\Annotations\PreFlush;
use Doctrine\ODM\MongoDB\Mapping\Annotations\PreLoad;
use Doctrine\ODM\MongoDB\Mapping\Annotations\PrePersist;
use Doctrine\ODM\MongoDB\Mapping\Annotations\PreRemove;
use Doctrine\ODM\MongoDB\Mapping\Annotations\PreUpdate;

/**
 * @Document
 * @HasLifecycleCallbacks
 */
class Lifecycle
{
    /** @Id */
    private string $id;

    /** @PrePersist */
    public function doStuffOnPrePersist(LifecycleEventArgs $eventArgs): void
    {
    }

    /** @PrePersist */
    public function doOtherStuffOnPrePersist(LifecycleEventArgs $eventArgs): void
    {
    }

    /** @PostPersist */
    public function doStuffOnPostPersist(LifecycleEventArgs $eventArgs): void
    {
    }

    /** @PreRemove */
    public function doStuffOnPreRemove(LifecycleEventArgs $eventArgs): void
    {
    }

    /** @PostRemove */
    public function doStuffOnPostRemove(LifecycleEventArgs $eventArgs): void
    {
    }

    /** @PreUpdate */
    public function doStuffOnPreUpdate(LifecycleEventArgs $eventArgs): void
    {
    }

    /** @PostUpdate */
    public function doStuffOnPostUpdate(LifecycleEventArgs $eventArgs): void
    {
    }

    /** @PreLoad */
    public function doStuffOnPreLoad(LifecycleEventArgs $eventArgs): void
    {
    }

    /** @PostLoad */
    public function doStuffOnPostLoad(LifecycleEventArgs $eventArgs): void
    {
    }

    /** @PreFlush */
    public function doStuffOnPreFlush(LifecycleEventArgs $eventArgs): void
    {
    }
}
