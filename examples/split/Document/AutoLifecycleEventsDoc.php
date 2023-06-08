<?php

declare(strict_types=1);

namespace Examples\Document;

use Doctrine\ODM\MongoDB\Event\LifecycleEventArgs;
use Examples\Entity\AutoLifecycleEvents;
use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class AutoLifecycleEventsDoc implements Document
{
    public static function map(DocumentMapping $mapping): void
    {
        $mapping->id();
    }

    public static function prePersist(LifecycleEventArgs $eventArgs)
    {
        /** @var AutoLifecycleEvents $document */
        $document = $eventArgs->getDocument();
    }
}
