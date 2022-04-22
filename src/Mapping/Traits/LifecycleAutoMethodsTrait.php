<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Mapping\Traits;

use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;

trait LifecycleAutoMethodsTrait
{
    protected bool $useLifecycleAutoMethods;

    public function enableLifecycleAutoMethods(bool $value): void
    {
        $this->useLifecycleAutoMethods = $value;
    }

    public function addLifecycleAutoMethods(DocumentBuilder $builder): void
    {
        if (!$this->useLifecycleAutoMethods) {
            return;
        }

        $lifecycleMethods = [
            'preRemove',
            'postRemove',
            'prePersist',
            'postPersist',
            'preUpdate',
            'postUpdate',
            'preLoad',
            'postLoad',
            'loadClassMetadata',
            'onClassMetadataNotFound',
            'preFlush',
            'postFlush',
            'onFlush',
            'onClear',
            'documentNotFound',
            'postCollectionLoad',
        ];

        foreach ($lifecycleMethods as $lifecycleMethod) {
            if (method_exists($this, $lifecycleMethod)) {
                $builder->lifecycle()->{$lifecycleMethod}($lifecycleMethod);
            }
        }
    }
}
