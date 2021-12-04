<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Method;

use Doctrine\ODM\MongoDB\Events;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Builder;
use yjiotpukc\MongoODMFluent\Type\Lifecycle;

class LifecycleBuilder implements Builder, Lifecycle
{
    protected array $lifecycleCallbacks = [];

    public function preRemove(string $method): LifecycleBuilder
    {
        $this->lifecycleCallbacks[] = [
            'event' => Events::preRemove,
            'method' => $method,
        ];

        return $this;
    }

    public function postRemove(string $method): LifecycleBuilder
    {
        $this->lifecycleCallbacks[] = [
            'event' => Events::postRemove,
            'method' => $method,
        ];

        return $this;
    }

    public function prePersist(string $method): LifecycleBuilder
    {
        $this->lifecycleCallbacks[] = [
            'event' => Events::prePersist,
            'method' => $method,
        ];

        return $this;
    }

    public function postPersist(string $method): LifecycleBuilder
    {
        $this->lifecycleCallbacks[] = [
            'event' => Events::postPersist,
            'method' => $method,
        ];

        return $this;
    }

    public function preUpdate(string $method): LifecycleBuilder
    {
        $this->lifecycleCallbacks[] = [
            'event' => Events::preUpdate,
            'method' => $method,
        ];

        return $this;
    }

    public function postUpdate(string $method): LifecycleBuilder
    {
        $this->lifecycleCallbacks[] = [
            'event' => Events::postUpdate,
            'method' => $method,
        ];

        return $this;
    }

    public function preLoad(string $method): LifecycleBuilder
    {
        $this->lifecycleCallbacks[] = [
            'event' => Events::preLoad,
            'method' => $method,
        ];

        return $this;
    }

    public function postLoad(string $method): LifecycleBuilder
    {
        $this->lifecycleCallbacks[] = [
            'event' => Events::postLoad,
            'method' => $method,
        ];

        return $this;
    }

    public function preFlush(string $method): LifecycleBuilder
    {
        $this->lifecycleCallbacks[] = [
            'event' => Events::preFlush,
            'method' => $method,
        ];

        return $this;
    }

    public function build(ClassMetadata $metadata): void
    {
        foreach ($this->lifecycleCallbacks as $lifecycleCallback) {
            $metadata->addLifecycleCallback($lifecycleCallback['method'], $lifecycleCallback['event']);
        }
    }
}