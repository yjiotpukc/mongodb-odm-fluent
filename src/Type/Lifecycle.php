<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type;

interface Lifecycle
{
    public function preRemove(string $method): Lifecycle;

    public function postRemove(string $method): Lifecycle;

    public function prePersist(string $method): Lifecycle;

    public function postPersist(string $method): Lifecycle;

    public function preUpdate(string $method): Lifecycle;

    public function postUpdate(string $method): Lifecycle;

    public function preLoad(string $method): Lifecycle;

    public function postLoad(string $method): Lifecycle;

    public function preFlush(string $method): Lifecycle;
}