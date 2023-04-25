<?php

declare(strict_types=1);

namespace Examples\Entity;

use Doctrine\ODM\MongoDB\Event\LifecycleEventArgs;
use Doctrine\ODM\MongoDB\Event\PreFlushEventArgs;
use Doctrine\ODM\MongoDB\Event\PreLoadEventArgs;
use Doctrine\ODM\MongoDB\Event\PreUpdateEventArgs;
use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class AutoLifecycle implements Document
{
    private string $id;

    public static function map(DocumentMapping $mapping): void
    {
        $mapping->id();
    }

    public static function isSuperclass(): bool
    {
        return false;
    }

    public function prePersist(LifecycleEventArgs $eventArgs): void
    {
    }

    public function postPersist(LifecycleEventArgs $eventArgs): void
    {
    }

    public function preRemove(LifecycleEventArgs $eventArgs): void
    {
    }

    public function postRemove(LifecycleEventArgs $eventArgs): void
    {
    }

    public function preUpdate(PreUpdateEventArgs $eventArgs): void
    {
    }

    public function postUpdate(LifecycleEventArgs $eventArgs): void
    {
    }

    public function preLoad(PreLoadEventArgs $eventArgs): void
    {
    }

    public function postLoad(LifecycleEventArgs $eventArgs): void
    {
    }

    public function preFlush(PreFlushEventArgs $eventArgs): void
    {
    }
}
