<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Database;

use yjiotpukc\MongoODMFluent\Builder\Database\ReadPreferenceBuilder;
use yjiotpukc\MongoODMFluent\MappingException;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\BuilderTestCase;

class ReadPreferenceTest extends BuilderTestCase
{
    protected ReadPreferenceBuilder $builder;

    public function testPrimaryMode(): void
    {
        $this->givenBuilder()->primary();

        $this->builder->build($this->metadata);

        self::assertSame('primary', $this->metadata->readPreference);
    }

    public function testPrimaryPreferredMode(): void
    {
        $this->givenBuilder()->primaryPreferred();

        $this->builder->build($this->metadata);

        self::assertSame('primaryPreferred', $this->metadata->readPreference);
    }

    public function testSecondaryMode(): void
    {
        $this->givenBuilder()->secondary();

        $this->builder->build($this->metadata);

        self::assertSame('secondary', $this->metadata->readPreference);
    }

    public function testSecondaryPreferredMode(): void
    {
        $this->givenBuilder()->secondaryPreferred();

        $this->builder->build($this->metadata);

        self::assertSame('secondaryPreferred', $this->metadata->readPreference);
    }

    public function testNearestMode(): void
    {
        $this->givenBuilder()->nearest();

        $this->builder->build($this->metadata);

        self::assertSame('nearest', $this->metadata->readPreference);
    }

    public function testFailsWithoutMode(): void
    {
        $this->expectException(MappingException::class);
        $this->expectExceptionMessage('Mode is required for read preference');

        $this->givenBuilder();

        $this->builder->build($this->metadata);
    }

    public function testWithoutTags(): void
    {
        $this->givenBuilder()->primary();

        $this->builder->build($this->metadata);

        self::assertSame([], $this->metadata->readPreferenceTags);
    }

    public function testTagSpecification(): void
    {
        $tags = ['tag1' => 'value1', 'tag2' => 'value2'];
        $this->givenBuilder()->primary()->tagSpecification($tags);

        $this->builder->build($this->metadata);

        self::assertSameArray([$tags], $this->metadata->readPreferenceTags);
    }

    public function testTagSet()
    {
        $tagSet = [
            ['tag1' => 'value1', 'tag2' => 'value2'],
            ['tag1' => 'value1'],
            [],
        ];
        $this->givenBuilder()->primary()->tagSet($tagSet);

        $this->builder->build($this->metadata);

        self::assertSameArray($tagSet, $this->metadata->readPreferenceTags);
    }

    public function testAny()
    {
        $this->givenBuilder()->primary()->tagSpecification(['tag1' => 'value1'])->any();

        $this->builder->build($this->metadata);

        self::assertSameArray([
            ['tag1' => 'value1'],
            [],
        ], $this->metadata->readPreferenceTags);
    }

    protected function givenBuilder(): ReadPreferenceBuilder
    {
        $this->builder = new ReadPreferenceBuilder();

        return $this->builder;
    }
}
