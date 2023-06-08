<?php

declare(strict_types=1);

namespace Examples\Document;

use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class LifecycleDoc implements Document
{
    public static function map(DocumentMapping $mapping): void
    {
        $mapping->id();
        $mapping->lifecycle()
            ->prePersist('doStuffOnPrePersist')
            ->prePersist('doOtherStuffOnPrePersist')
            ->postPersist('doStuffOnPostPersist')
            ->preRemove('doStuffOnPreRemove')
            ->postRemove('doStuffOnPostRemove')
            ->preUpdate('doStuffOnPreUpdate')
            ->postUpdate('doStuffOnPostUpdate')
            ->preLoad('doStuffOnPreLoad')
            ->postLoad('doStuffOnPostLoad')
            ->preFlush('doStuffOnPreFlush');
    }
}
