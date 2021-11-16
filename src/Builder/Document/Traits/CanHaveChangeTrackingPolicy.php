<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document\Traits;

use yjiotpukc\MongoODMFluent\Builder\Database\ChangeTrackingPolicyBuilder;
use yjiotpukc\MongoODMFluent\Type\ChangeTrackingPolicy;

trait CanHaveChangeTrackingPolicy
{
    public function changeTrackingPolicy(): ChangeTrackingPolicy
    {
        return $this->addBuilder(new ChangeTrackingPolicyBuilder());
    }
}
