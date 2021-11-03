<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder;

use yjiotpukc\MongoODMFluent\Builder\Document\EmbeddedDocumentBuilder;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\AnotherEntityStub;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field\EmbedManyTest;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field\EmbedOneTest;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field\FieldTest;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field\IdTest;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field\ReferenceManyTest;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field\ReferenceOneTest;

class EmbeddedDocumentTest extends BuilderTestCase
{
    public function testIndex()
    {
        $this->givenBuilder()->index('id');
        $this->builder->build($this->metadata);

        self::assertSameArray([
            [
                'keys' => ['id' => 1],
                'options' => [],
            ]
        ], $this->metadata->indexes);
    }

    public function testTwoIndexes()
    {
        $this->givenBuilder()->index('id');
        $this->builder->index('name');
        $this->builder->build($this->metadata);

        self::assertSameArray([
            [
                'keys' => ['id' => 1],
                'options' => [],
            ],
            [
                'keys' => ['name' => 1],
                'options' => [],
            ],
        ], $this->metadata->indexes);
    }

    public function testId()
    {
        $this->givenBuilder()->id();
        $this->builder->build($this->metadata);

        self::assertSameArray(
            IdTest::getDefaultMapping(),
            $this->metadata->fieldMappings[IdTest::getDefaultFieldName()]
        );
    }

    public function testField()
    {
        $this->givenBuilder()->field('string', FieldTest::getDefaultFieldName());
        $this->builder->build($this->metadata);

        self::assertSameArray(
            FieldTest::getDefaultMapping(),
            $this->metadata->fieldMappings[FieldTest::getDefaultFieldName()]
        );
    }

    public function testReferenceOne()
    {
        $this->givenBuilder()->referenceOne(ReferenceOneTest::getDefaultFieldName(), AnotherEntityStub::class);
        $this->builder->build($this->metadata);

        self::assertSameArray(
            ReferenceOneTest::getDefaultMapping(),
            $this->metadata->fieldMappings[ReferenceOneTest::getDefaultFieldName()]
        );
    }

    public function testReferenceMany()
    {
        $this->givenBuilder()->referenceMany(ReferenceManyTest::getDefaultFieldName(), AnotherEntityStub::class);
        $this->builder->build($this->metadata);

        self::assertSameArray(
            ReferenceManyTest::getDefaultMapping(),
            $this->metadata->fieldMappings[ReferenceManyTest::getDefaultFieldName()]
        );
    }

    public function testEmbedOne()
    {
        $this->givenBuilder()->embedOne(EmbedOneTest::getDefaultFieldName(), AnotherEntityStub::class);
        $this->builder->build($this->metadata);

        self::assertSameArray(
            EmbedOneTest::getDefaultMapping(),
            $this->metadata->fieldMappings[EmbedOneTest::getDefaultFieldName()]
        );
    }

    public function testEmbedMany()
    {
        $this->givenBuilder()->embedMany(EmbedManyTest::getDefaultFieldName(), AnotherEntityStub::class);
        $this->builder->build($this->metadata);

        self::assertSameArray(
            EmbedManyTest::getDefaultMapping(),
            $this->metadata->fieldMappings[EmbedManyTest::getDefaultFieldName()]
        );
    }

    protected function givenBuilder(): EmbeddedDocumentBuilder
    {
        $this->builder = new EmbeddedDocumentBuilder();

        return $this->builder;
    }
}
