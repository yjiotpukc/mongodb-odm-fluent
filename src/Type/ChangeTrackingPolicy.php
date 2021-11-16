<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type;

interface ChangeTrackingPolicy
{
    public function deferredImplicit(): void;

    public function deferredExplicit(): void;

    public function notify(): void;
}
