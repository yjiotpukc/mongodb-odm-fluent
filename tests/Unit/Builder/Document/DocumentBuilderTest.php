<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Document;

use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;
use yjiotpukc\MongoODMFluent\Tests\Stubs\AnotherEntityStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\RepositoryStub;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\BuilderTestCase;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field\EmbedManyTest;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field\EmbedOneTest;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field\FieldTest;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field\IdTest;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field\ReferenceManyTest;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field\ReferenceOneTest;

class DocumentBuilderTest extends BuilderTestCase
{
    protected DocumentBuilder $builder;

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

    public function testShard()
    {
        $this->givenBuilder()->shard()->asc('year');

        $this->builder->build($this->metadata);

        self::assertSame([
            'keys' => ['year' => 1],
            'options' => [],
        ], $this->metadata->getShardKey());
    }

    public function testChangeTrackingPolicy()
    {
        $this->givenBuilder()->changeTrackingPolicy()->deferredExplicit();

        $this->builder->build($this->metadata);

        self::assertTrue($this->metadata->isChangeTrackingDeferredExplicit());
    }

    public function testRootClass(): void
    {
        $this->givenBuilder()->rootClass(AnotherEntityStub::class);

        $this->builder->build($this->metadata);

        self::assertSame(AnotherEntityStub::class, $this->metadata->getRootClass());
    }

    public function testViewName(): void
    {
        $this->givenBuilder()->view('my_view');

        $this->builder->build($this->metadata);

        self::assertSame('my_view', $this->metadata->getCollection());
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

        $this->assertFieldBuildsCorrectly();
    }

    public function testString()
    {
        $this->givenBuilder()->string(FieldTest::getDefaultFieldName());

        $this->assertFieldBuildsCorrectly();
    }

    public function testInt()
    {
        $this->givenBuilder()->int(FieldTest::getDefaultFieldName());

        $this->assertFieldBuildsCorrectly(['type' => 'int']);
    }

    public function testFloat()
    {
        $this->givenBuilder()->float(FieldTest::getDefaultFieldName());

        $this->assertFieldBuildsCorrectly(['type' => 'float']);
    }

    public function testBool()
    {
        $this->givenBuilder()->bool(FieldTest::getDefaultFieldName());

        $this->assertFieldBuildsCorrectly(['type' => 'boolean']);
    }

    public function testTimestamp()
    {
        $this->givenBuilder()->timestamp(FieldTest::getDefaultFieldName());

        $this->assertFieldBuildsCorrectly(['type' => 'timestamp']);
    }

    public function testDate()
    {
        $this->givenBuilder()->date(FieldTest::getDefaultFieldName());

        $this->assertFieldBuildsCorrectly(['type' => 'date']);
    }

    public function testDateImmutable()
    {
        $this->givenBuilder()->dateImmutable(FieldTest::getDefaultFieldName());

        $this->assertFieldBuildsCorrectly(['type' => 'date_immutable']);
    }

    public function testDecimal()
    {
        $this->givenBuilder()->decimal(FieldTest::getDefaultFieldName());

        $this->assertFieldBuildsCorrectly(['type' => 'decimal128']);
    }

    public function testArray()
    {
        $this->givenBuilder()->array(FieldTest::getDefaultFieldName());

        $this->assertFieldBuildsCorrectly(['type' => 'collection']);
    }

    public function testHash()
    {
        $this->givenBuilder()->hash(FieldTest::getDefaultFieldName());

        $this->assertFieldBuildsCorrectly(['type' => 'hash']);
    }

    public function testKey()
    {
        $this->givenBuilder()->key(FieldTest::getDefaultFieldName());

        $this->assertFieldBuildsCorrectly(['type' => 'key']);
    }

    public function testObjectId()
    {
        $this->givenBuilder()->objectId(FieldTest::getDefaultFieldName());

        $this->assertFieldBuildsCorrectly(['type' => 'object_id']);
    }

    public function testRaw()
    {
        $this->givenBuilder()->raw(FieldTest::getDefaultFieldName());

        $this->assertFieldBuildsCorrectly(['type' => 'raw']);
    }

    public function testBin()
    {
        $this->givenBuilder()->bin(FieldTest::getDefaultFieldName());

        $this->assertFieldBuildsCorrectly(['type' => 'bin']);
    }

    public function testBinBytearray()
    {
        $this->givenBuilder()->binBytearray(FieldTest::getDefaultFieldName());

        $this->assertFieldBuildsCorrectly(['type' => 'bin_bytearray']);
    }

    public function testBinCustom()
    {
        $this->givenBuilder()->binCustom(FieldTest::getDefaultFieldName());

        $this->assertFieldBuildsCorrectly(['type' => 'bin_custom']);
    }

    public function testBinFunc()
    {
        $this->givenBuilder()->binFunc(FieldTest::getDefaultFieldName());

        $this->assertFieldBuildsCorrectly(['type' => 'bin_func']);
    }

    public function testBinMd5()
    {
        $this->givenBuilder()->binMd5(FieldTest::getDefaultFieldName());

        $this->assertFieldBuildsCorrectly(['type' => 'bin_md5']);
    }

    public function testBinUuid()
    {
        $this->givenBuilder()->binUuid(FieldTest::getDefaultFieldName());

        $this->assertFieldBuildsCorrectly(['type' => 'bin_uuid']);
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
            ],
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
        $this->givenBuilder()
            ->discriminator('type')
            ->map('physical', AnotherEntityStub::class)
            ->default('physical');
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

    public function testReadPreference()
    {
        $this->givenBuilder()->readPreference()->secondary()->any();

        $this->builder->build($this->metadata);

        self::assertSame('secondary', $this->metadata->readPreference);
        self::assertSame([[]], $this->metadata->readPreferenceTags);
    }

    public function testLifecycle()
    {
        $this->givenBuilder()->lifecycle()->prePersist('callback');

        $this->builder->build($this->metadata);

        self::assertSameArray(['prePersist' => ['callback']], $this->metadata->lifecycleCallbacks);
    }

    public function testAlsoLoadMethod()
    {
        $this->givenBuilder()->alsoLoad('populateFirstAndLastName', ['name', 'fullName']);

        $this->builder->build($this->metadata);

        self::assertSameArray([
            'populateFirstAndLastName' => ['name', 'fullName']
        ], $this->metadata->alsoLoadMethods);
    }

    protected function givenBuilder(): DocumentBuilder
    {
        $this->builder = new DocumentBuilder();

        return $this->builder;
    }

    protected function assertFieldBuildsCorrectly(array $expectedFields = [])
    {
        $this->builder->build($this->metadata);

        $expectedFields = array_merge(FieldTest::getDefaultMapping(), $expectedFields);
        $fieldMapping = $this->metadata->fieldMappings[FieldTest::getDefaultFieldName()];

        self::assertSameArray($expectedFields, $fieldMapping);
    }
}
