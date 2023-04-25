<?php

declare(strict_types=1);

namespace Examples\Entity;

use Doctrine\ODM\MongoDB\Event\LifecycleEventArgs;
use Doctrine\ODM\MongoDB\Event\PreFlushEventArgs;
use Doctrine\ODM\MongoDB\Event\PreLoadEventArgs;
use Doctrine\ODM\MongoDB\Event\PreUpdateEventArgs;
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
class AutoLifecycle
{
    /** @Id */
    private string $id;

    /** @PrePersist */
    public function prePersist(LifecycleEventArgs $eventArgs): void
    {
    }

    /** @PostPersist */
    public function postPersist(LifecycleEventArgs $eventArgs): void
    {
    }

    /** @PreRemove */
    public function preRemove(LifecycleEventArgs $eventArgs): void
    {
    }

    /** @PostRemove */
    public function postRemove(LifecycleEventArgs $eventArgs): void
    {
    }

    /** @PreUpdate */
    public function preUpdate(PreUpdateEventArgs $eventArgs): void
    {
    }

    /** @PostUpdate */
    public function postUpdate(LifecycleEventArgs $eventArgs): void
    {
    }

    /** @PreLoad */
    public function preLoad(PreLoadEventArgs $eventArgs): void
    {
    }

    /** @PostLoad */
    public function postLoad(LifecycleEventArgs $eventArgs): void
    {
    }

    /** @PreFlush */
    public function preFlush(PreFlushEventArgs $eventArgs): void
    {
    }
}
