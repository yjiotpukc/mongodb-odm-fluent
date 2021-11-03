<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder;

use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\AnotherEntityStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\RepositoryStub;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field\EmbedManyTest;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field\EmbedOneTest;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field\FieldTest;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field\IdTest;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field\ReferenceManyTest;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field\ReferenceOneTest;
use yjiotpukc\MongoODMFluent\Type\Discriminator;

class DocumentBuilderTest extends BuilderTestCase
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

    public function testDiscriminator()
    {
        $discriminator = (new Discriminator('type'))
            ->map('physical', AnotherEntityStub::class)
            ->default('physical');
        $discriminatorBuilder = new \yjiotpukc\MongoODMFluent\Builder\Database\Discriminator($discriminator);

        $this->givenBuilder()->discriminator($discriminatorBuilder);
        $this->builder->build($this->metadata);

        self::assertSame('physical', $this->metadata->defaultDiscriminatorValue);
        self::assertSame('type', $this->metadata->discriminatorField);
        self::assertSame(['physical' => AnotherEntityStub::class], $this->metadata->discriminatorMap);
    }

    public function testRepository()
    {
        $this->givenBuilder()->repository(RepositoryStub::class);
        $this->builder->build($this->metadata);

        self::assertSame(RepositoryStub::class, $this->metadata->customRepositoryClassName);
    }

    public function testReadOnly()
    {
        $this->givenBuilder()->readOnly();
        $this->builder->build($this->metadata);

        self::assertTrue($this->metadata->isReadOnly);
    }

    public function testWriteConcern()
    {
        $this->givenBuilder()->writeConcern('some');
        $this->builder->build($this->metadata);

        self::assertSame('some', $this->metadata->getWriteConcern());
    }

    protected function givenBuilder(): DocumentBuilder
    {
        $this->builder = new DocumentBuilder();

        return $this->builder;
    }
}
