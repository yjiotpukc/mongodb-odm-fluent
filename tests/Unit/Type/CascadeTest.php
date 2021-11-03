<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Type;

use PHPUnit\Framework\TestCase;
use yjiotpukc\MongoODMFluent\Type\Cascade;

class CascadeTest extends TestCase
{
    public function testAll()
    {
        $cascade = (new Cascade())->all();

        self::assertSame([
            'detach',
            'merge',
            'refresh',
            'remove',
            'persist',
        ], $cascade->cascades);
    }

    public function testDetach()
    {
        $cascade = (new Cascade())->detach();

        self::assertSame(['detach'], $cascade->cascades);
    }

    public function testMerge()
    {
        $cascade = (new Cascade())->merge();

        self::assertSame(['merge'], $cascade->cascades);
    }

    public function testRefresh()
    {
        $cascade = (new Cascade())->refresh();

        self::assertSame(['refresh'], $cascade->cascades);
    }

    public function testRemove()
    {
        $cascade = (new Cascade())->remove();

        self::assertSame(['remove'], $cascade->cascades);
    }

    public function testPersist()
    {
        $cascade = (new Cascade())->persist();

        self::assertSame(['persist'], $cascade->cascades);
    }
}
