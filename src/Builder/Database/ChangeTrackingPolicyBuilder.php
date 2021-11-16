<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Database;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Builder;
use yjiotpukc\MongoODMFluent\Type\ChangeTrackingPolicy;

class ChangeTrackingPolicyBuilder implements Builder, ChangeTrackingPolicy
{
    protected int $policy;

    public function deferredImplicit(): void
    {
        $this->policy = ClassMetadata::CHANGETRACKING_DEFERRED_IMPLICIT;
    }

    public function deferredExplicit(): void
    {
        $this->policy = ClassMetadata::CHANGETRACKING_DEFERRED_EXPLICIT;
    }

    public function notify(): void
    {
        $this->policy = ClassMetadata::CHANGETRACKING_NOTIFY;
    }

    public function build(ClassMetadata $metadata): void
    {
        $metadata->setChangeTrackingPolicy($this->policy);
    }
}
