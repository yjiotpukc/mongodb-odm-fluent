<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Method;

use yjiotpukc\MongoODMFluent\Builder\Method\LifecycleBuilder;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\BuilderTestCase;

class LifecycleTest extends BuilderTestCase
{
    public function testPreRemove(): void
    {
        $builder = $this->givenBuilder()->preRemove('callback');

        $builder->build($this->metadata);

        $this->assertHasCallback('preRemove');
    }

    protected function givenBuilder(): LifecycleBuilder
    {
        return new LifecycleBuilder();
    }

    protected function assertHasCallback(string $event): void
    {
        self::assertSameArray([$event => ['callback']], $this->metadata->lifecycleCallbacks);
    }

    public function testPostRemove(): void
    {
        $builder = $this->givenBuilder()->postRemove('callback');

        $builder->build($this->metadata);

        $this->assertHasCallback('postRemove');
    }

    public function testPrePersist(): void
    {
        $builder = $this->givenBuilder()->prePersist('callback');

        $builder->build($this->metadata);

        $this->assertHasCallback('prePersist');
    }

    public function testPostPersist(): void
    {
        $builder = $this->givenBuilder()->postPersist('callback');

        $builder->build($this->metadata);

        $this->assertHasCallback('postPersist');
    }

    public function testPreUpdate(): void
    {
        $builder = $this->givenBuilder()->preUpdate('callback');

        $builder->build($this->metadata);

        $this->assertHasCallback('preUpdate');
    }

    public function testPostUpdate(): void
    {
        $builder = $this->givenBuilder()->postUpdate('callback');

        $builder->build($this->metadata);

        $this->assertHasCallback('postUpdate');
    }

    public function testPreLoad(): void
    {
        $builder = $this->givenBuilder()->preLoad('callback');

        $builder->build($this->metadata);

        $this->assertHasCallback('preLoad');
    }

    public function testPostLoad(): void
    {
        $builder = $this->givenBuilder()->postLoad('callback');

        $builder->build($this->metadata);

        $this->assertHasCallback('postLoad');
    }

    public function testPreFlush(): void
    {
        $builder = $this->givenBuilder()->preFlush('callback');

        $builder->build($this->metadata);

        $this->assertHasCallback('preFlush');
    }
}
