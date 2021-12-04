<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Method;

use yjiotpukc\MongoODMFluent\Builder\Method\LifecycleBuilder;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\BuilderTestCase;

class LifecycleTest extends BuilderTestCase
{
    public function testPreRemove()
    {
        $builder = $this->givenBuilder()->preRemove('callback');

        $builder->build($this->metadata);

        $this->assertHasCallback('preRemove');
    }

    public function testPostRemove()
    {
        $builder = $this->givenBuilder()->postRemove('callback');

        $builder->build($this->metadata);

        $this->assertHasCallback('postRemove');
    }

    public function testPrePersist()
    {
        $builder = $this->givenBuilder()->prePersist('callback');

        $builder->build($this->metadata);

        $this->assertHasCallback('prePersist');
    }

    public function testPostPersist()
    {
        $builder = $this->givenBuilder()->postPersist('callback');

        $builder->build($this->metadata);

        $this->assertHasCallback('postPersist');
    }

    public function testPreUpdate()
    {
        $builder = $this->givenBuilder()->preUpdate('callback');

        $builder->build($this->metadata);

        $this->assertHasCallback('preUpdate');
    }

    public function testPostUpdate()
    {
        $builder = $this->givenBuilder()->postUpdate('callback');

        $builder->build($this->metadata);

        $this->assertHasCallback('postUpdate');
    }

    public function testPreLoad()
    {
        $builder = $this->givenBuilder()->preLoad('callback');

        $builder->build($this->metadata);

        $this->assertHasCallback('preLoad');
    }

    public function testPostLoad()
    {
        $builder = $this->givenBuilder()->postLoad('callback');

        $builder->build($this->metadata);

        $this->assertHasCallback('postLoad');
    }

    public function testPreFlush()
    {
        $builder = $this->givenBuilder()->preFlush('callback');

        $builder->build($this->metadata);

        $this->assertHasCallback('preFlush');
    }

    protected function givenBuilder(): LifecycleBuilder
    {
        return new LifecycleBuilder();
    }

    protected function assertHasCallback(string $event)
    {
        self::assertSameArray([$event => ['callback']], $this->metadata->lifecycleCallbacks);
    }
}
