<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Database;

use yjiotpukc\MongoODMFluent\Builder\Database\ChangeTrackingPolicyBuilder;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\BuilderTestCase;

class ChangeTrackingPolicyTest extends BuilderTestCase
{
    public function testDeferredImplicit()
    {
        $changeTrackingPolicy = new ChangeTrackingPolicyBuilder();

        $changeTrackingPolicy->deferredImplicit();
        $changeTrackingPolicy->build($this->metadata);

        self::assertTrue($this->metadata->isChangeTrackingDeferredImplicit());
    }
    public function testDeferredExplicit()
    {
        $changeTrackingPolicy = new ChangeTrackingPolicyBuilder();

        $changeTrackingPolicy->deferredExplicit();
        $changeTrackingPolicy->build($this->metadata);

        self::assertTrue($this->metadata->isChangeTrackingDeferredExplicit());
    }
    public function testNotify()
    {
        $changeTrackingPolicy = new ChangeTrackingPolicyBuilder();

        $changeTrackingPolicy->notify();
        $changeTrackingPolicy->build($this->metadata);

        self::assertTrue($this->metadata->isChangeTrackingNotify());
    }
}
