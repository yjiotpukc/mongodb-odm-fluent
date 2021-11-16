<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field;

use PHPUnit\Framework\TestCase;
use yjiotpukc\MongoODMFluent\Builder\Field\CascadePartial;

class CascadeTest extends TestCase
{
    public function testAll()
    {
        $cascadeBuilder = new CascadePartial();
        $cascadeBuilder->all();

        self::assertSame([
            'cascade' => [
                'detach',
                'merge',
                'refresh',
                'remove',
                'persist',
            ],
        ], $cascadeBuilder->toMapping());
    }

    public function testDetach()
    {
        $cascadeBuilder = new CascadePartial();
        $cascadeBuilder->detach();

        self::assertSame(['cascade' => ['detach']], $cascadeBuilder->toMapping());
    }

    public function testMerge()
    {
        $cascadeBuilder = new CascadePartial();
        $cascadeBuilder->merge();

        self::assertSame(['cascade' => ['merge']], $cascadeBuilder->toMapping());
    }

    public function testRefresh()
    {
        $cascadeBuilder = new CascadePartial();
        $cascadeBuilder->refresh();

        self::assertSame(['cascade' => ['refresh']], $cascadeBuilder->toMapping());
    }

    public function testRemove()
    {
        $cascadeBuilder = new CascadePartial();
        $cascadeBuilder->remove();

        self::assertSame(['cascade' => ['remove']], $cascadeBuilder->toMapping());
    }

    public function testPersist()
    {
        $cascadeBuilder = new CascadePartial();
        $cascadeBuilder->persist();

        self::assertSame(['cascade' => ['persist']], $cascadeBuilder->toMapping());
    }
}
