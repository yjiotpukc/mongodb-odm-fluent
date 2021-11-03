<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder;

use yjiotpukc\MongoODMFluent\Builder\Document\MappedSuperclassBuilder;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\AnotherEntityStub;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field\EmbedManyTest;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field\EmbedOneTest;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field\FieldTest;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field\IdTest;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field\ReferenceManyTest;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field\ReferenceOneTest;

class MappedSuperclassBuilderTest extends BuilderTestCase
{
    public function testDb()
    {
        $this->givenBuilder()->db('dbName');
        $this->builder->build($this->metadata);

        self::assertSame('dbName', $this->metadata->db);
    }

    public function testCollection()
    {
        $this->givenBuilder()->collection('collectionName');
        $this->builder->build($this->metadata);

        self::assertSame('collectionName', $this->metadata->collection);
    }

    public function testSingleCollection()
    {
        $this->givenBuilder()->singleCollection();
        $this->builder->build($this->metadata);

        self::assertTrue($this->metadata->isInheritanceTypeSingleCollection());
    }

    public function testCollectionPerClass()
    {
        $this->givenBuilder()->collectionPerClass();
        $this->builder->build($this->metadata);

        self::assertTrue($this->metadata->isInheritanceTypeCollectionPerClass());
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

    protected function givenBuilder(): MappedSuperclassBuilder
    {
        $this->builder = new MappedSuperclassBuilder();

        return $this->builder;
    }
}
