<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Mapping\Traits;

use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;
use yjiotpukc\MongoODMFluent\EventListener;

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

        $entity = $this->metadata->name;
        $document = get_class($this->document);

        $eventListener = new EventListener($document);

        foreach (static::getLifecycleMethods() as $lifecycleMethod) {
            if (method_exists($entity, $lifecycleMethod)) {
                $builder->lifecycle()->{$lifecycleMethod}($lifecycleMethod);
            } elseif (method_exists($document, $lifecycleMethod)) {
                $this->eventManager->addEventListener($lifecycleMethod, $eventListener);
            }
        }
    }

    protected static function getLifecycleMethods(): array
    {
        return [
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
    }
}
