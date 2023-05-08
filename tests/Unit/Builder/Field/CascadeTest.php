<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field;

use PHPUnit\Framework\TestCase;
use yjiotpukc\MongoODMFluent\Builder\Field\CascadePartial;

class CascadeTest extends TestCase
{
    public function testAll(): void
    {
        $cascadeBuilder = new CascadePartial();
        $cascadeBuilder->all();

        self::assertSame([
            'cascade' => [
                'remove',
                'persist',
                'refresh',
                'merge',
                'detach',
            ],
        ], $cascadeBuilder->toMapping());
    }

    public function testDetach(): void
    {
        $cascadeBuilder = new CascadePartial();
        $cascadeBuilder->detach();

        self::assertSame(['cascade' => ['detach']], $cascadeBuilder->toMapping());
    }

    public function testMerge(): void
    {
        $cascadeBuilder = new CascadePartial();
        $cascadeBuilder->merge();

        self::assertSame(['cascade' => ['merge']], $cascadeBuilder->toMapping());
    }

    public function testRefresh(): void
    {
        $cascadeBuilder = new CascadePartial();
        $cascadeBuilder->refresh();

        self::assertSame(['cascade' => ['refresh']], $cascadeBuilder->toMapping());
    }

    public function testRemove(): void
    {
        $cascadeBuilder = new CascadePartial();
        $cascadeBuilder->remove();

        self::assertSame(['cascade' => ['remove']], $cascadeBuilder->toMapping());
    }

    public function testPersist(): void
    {
        $cascadeBuilder = new CascadePartial();
        $cascadeBuilder->persist();

        self::assertSame(['cascade' => ['persist']], $cascadeBuilder->toMapping());
    }
}
