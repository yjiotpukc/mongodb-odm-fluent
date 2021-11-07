<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use PHPUnit\Framework\TestCase;
use yjiotpukc\MongoODMFluent\Builder\Builder;
use yjiotpukc\MongoODMFluent\Tests\Stubs\EntityStub;

abstract class BuilderTestCase extends TestCase
{
    protected ClassMetadata $metadata;
    protected Builder $builder;

    public static function assertSameArray(array $expected, array $actual)
    {
        ksort($expected);
        ksort($actual);

        static::assertSame($expected, $actual);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->givenClassMetadata();
    }

    public function givenClassMetadata(): ClassMetadata
    {
        $this->metadata = new ClassMetadata(EntityStub::class);

        return $this->metadata;
    }
}
