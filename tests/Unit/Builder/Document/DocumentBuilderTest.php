<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Document;

use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;
use yjiotpukc\MongoODMFluent\Tests\Stubs\AnotherEntityStub;
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

    public function testDb(): void
    {
        $this->givenBuilder()->db('dbName');

        $this->builder->build($this->metadata);

        self::assertSame('dbName', $this->metadata->db);
    }

    protected function givenBuilder(): DocumentBuilder
    {
        $this->builder = new DocumentBuilder();

        return $this->builder;
    }

    public function testCollection(): void
    {
        $this->givenBuilder()->collection('collectionName');

        $this->builder->build($this->metadata);

        self::assertSame('collectionName', $this->metadata->collection);
    }

    public function testShard(): void
    {
        $this->givenBuilder()->shard()->asc('year');

        $this->builder->build($this->metadata);

        self::assertSame([
            'keys' => ['year' => 1],
            'options' => [],
        ], $this->metadata->getShardKey());
    }

    public function testChangeTrackingPolicy(): void
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

    public function testId(): void
    {
        $this->givenBuilder()->id();
        $this->builder->build($this->metadata);

        self::assertSameArray(
            IdTest::getDefaultMapping(),
            $this->metadata->fieldMappings[IdTest::getDefaultFieldName()]
        );
    }

    public function testField(): void
    {
        $this->givenBuilder()->field('string', FieldTest::getDefaultFieldName());

        $this->assertFieldBuildsCorrectly();
    }

    protected function assertFieldBuildsCorrectly(array $expectedFields = []): void
    {
        $this->builder->build($this->metadata);

        $expectedFields = array_merge(FieldTest::getDefaultMapping(), $expectedFields);
        $fieldMapping = $this->metadata->fieldMappings[FieldTest::getDefaultFieldName()];

        self::assertSameArray($expectedFields, $fieldMapping);
    }

    public function testString(): void
    {
        $this->givenBuilder()->string(FieldTest::getDefaultFieldName());

        $this->assertFieldBuildsCorrectly();
    }

    public function testInt(): void
    {
        $this->givenBuilder()->int(FieldTest::getDefaultFieldName());

        $this->assertFieldBuildsCorrectly(['type' => 'int']);
    }

    public function testFloat(): void
    {
        $this->givenBuilder()->float(FieldTest::getDefaultFieldName());

        $this->assertFieldBuildsCorrectly(['type' => 'float']);
    }

    public function testBool(): void
    {
        $this->givenBuilder()->bool(FieldTest::getDefaultFieldName());

        $this->assertFieldBuildsCorrectly(['type' => 'bool']);
    }

    public function testTimestamp(): void
    {
        $this->givenBuilder()->timestamp(FieldTest::getDefaultFieldName());

        $this->assertFieldBuildsCorrectly(['type' => 'timestamp']);
    }

    public function testDate(): void
    {
        $this->givenBuilder()->date(FieldTest::getDefaultFieldName());

        $this->assertFieldBuildsCorrectly(['type' => 'date']);
    }

    public function testDateImmutable(): void
    {
        $this->givenBuilder()->dateImmutable(FieldTest::getDefaultFieldName());

        $this->assertFieldBuildsCorrectly(['type' => 'date_immutable']);
    }

    public function testDecimal(): void
    {
        $this->givenBuilder()->decimal(FieldTest::getDefaultFieldName());

        $this->assertFieldBuildsCorrectly(['type' => 'decimal128']);
    }

    public function testArray(): void
    {
        $this->givenBuilder()->array(FieldTest::getDefaultFieldName());

        $this->assertFieldBuildsCorrectly(['type' => 'collection']);
    }

    public function testHash(): void
    {
        $this->givenBuilder()->hash(FieldTest::getDefaultFieldName());

        $this->assertFieldBuildsCorrectly(['type' => 'hash']);
    }

    public function testKey(): void
    {
        $this->givenBuilder()->key(FieldTest::getDefaultFieldName());

        $this->assertFieldBuildsCorrectly(['type' => 'key']);
    }

    public function testObjectId(): void
    {
        $this->givenBuilder()->objectId(FieldTest::getDefaultFieldName());

        $this->assertFieldBuildsCorrectly(['type' => 'object_id']);
    }

    public function testRaw(): void
    {
        $this->givenBuilder()->raw(FieldTest::getDefaultFieldName());

        $this->assertFieldBuildsCorrectly(['type' => 'raw']);
    }

    public function testBin(): void
    {
        $this->givenBuilder()->bin(FieldTest::getDefaultFieldName());

        $this->assertFieldBuildsCorrectly(['type' => 'bin']);
    }

    public function testBinBytearray(): void
    {
        $this->givenBuilder()->binBytearray(FieldTest::getDefaultFieldName());

        $this->assertFieldBuildsCorrectly(['type' => 'bin_bytearray']);
    }

    public function testBinCustom(): void
    {
        $this->givenBuilder()->binCustom(FieldTest::getDefaultFieldName());

        $this->assertFieldBuildsCorrectly(['type' => 'bin_custom']);
    }

    public function testBinFunc(): void
    {
        $this->givenBuilder()->binFunc(FieldTest::getDefaultFieldName());

        $this->assertFieldBuildsCorrectly(['type' => 'bin_func']);
    }

    public function testBinMd5(): void
    {
        $this->givenBuilder()->binMd5(FieldTest::getDefaultFieldName());

        $this->assertFieldBuildsCorrectly(['type' => 'bin_md5']);
    }

    public function testBinUuid(): void
    {
        $this->givenBuilder()->binUuid(FieldTest::getDefaultFieldName());

        $this->assertFieldBuildsCorrectly(['type' => 'bin_uuid']);
    }

    public function testReferenceOne(): void
    {
        $this->givenBuilder()->referenceOne(ReferenceOneTest::getDefaultFieldName(), AnotherEntityStub::class);
        $this->builder->build($this->metadata);

        self::assertSameArray(
            ReferenceOneTest::getDefaultMapping(),
            $this->metadata->fieldMappings[ReferenceOneTest::getDefaultFieldName()]
        );
    }

    public function testReferenceMany(): void
    {
        $this->givenBuilder()->referenceMany(ReferenceManyTest::getDefaultFieldName(), AnotherEntityStub::class);
        $this->builder->build($this->metadata);

        self::assertSameArray(
            ReferenceManyTest::getDefaultMapping(),
            $this->metadata->fieldMappings[ReferenceManyTest::getDefaultFieldName()]
        );
    }

    public function testEmbedOne(): void
    {
        $this->givenBuilder()->embedOne(EmbedOneTest::getDefaultFieldName(), AnotherEntityStub::class);
        $this->builder->build($this->metadata);

        self::assertSameArray(
            EmbedOneTest::getDefaultMapping(),
            $this->metadata->fieldMappings[EmbedOneTest::getDefaultFieldName()]
        );
    }

    public function testEmbedMany(): void
    {
        $this->givenBuilder()->embedMany(EmbedManyTest::getDefaultFieldName(), AnotherEntityStub::class);
        $this->builder->build($this->metadata);

        self::assertSameArray(
            EmbedManyTest::getDefaultMapping(),
            $this->metadata->fieldMappings[EmbedManyTest::getDefaultFieldName()]
        );
    }

    public function testIndex(): void
    {
        $this->givenBuilder()->index('id');
        $this->builder->build($this->metadata);

        self::assertSameArray([
            [
                'keys' => ['id' => 1],
                'options' => [
                    'unique' => false,
                    'sparse' => false,
                ],
            ],
        ], $this->metadata->indexes);
    }

    public function testTwoIndexes(): void
    {
        $this->givenBuilder()->index('id');
        $this->builder->index('name');
        $this->builder->build($this->metadata);

        self::assertSameArray([
            [
                'keys' => ['id' => 1],
                'options' => [
                    'unique' => false,
                    'sparse' => false,
                ],
            ],
            [
                'keys' => ['name' => 1],
                'options' => [
                    'unique' => false,
                    'sparse' => false,
                ],
            ],
        ], $this->metadata->indexes);
    }

    public function testSingleCollection(): void
    {
        $this->givenBuilder()->singleCollection();
        $this->builder->build($this->metadata);

        self::assertTrue($this->metadata->isInheritanceTypeSingleCollection());
    }

    public function testCollectionPerClass(): void
    {
        $this->givenBuilder()->collectionPerClass();
        $this->builder->build($this->metadata);

        self::assertTrue($this->metadata->isInheritanceTypeCollectionPerClass());
    }

    public function testDiscriminator(): void
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

    public function testRepository(): void
    {
        $this->givenBuilder()->repository('RepositoryClassname');
        $this->builder->build($this->metadata);

        self::assertSame('RepositoryClassname', $this->metadata->customRepositoryClassName);
    }

    public function testReadOnly(): void
    {
        $this->givenBuilder()->readOnly();
        $this->builder->build($this->metadata);

        self::assertTrue($this->metadata->isReadOnly);
    }

    public function testWriteConcern(): void
    {
        $this->givenBuilder()->writeConcern('some');
        $this->builder->build($this->metadata);

        self::assertSame('some', $this->metadata->getWriteConcern());
    }

    public function testReadPreference(): void
    {
        $this->givenBuilder()->readPreference()->secondary()->any();

        $this->builder->build($this->metadata);

        self::assertSame('secondary', $this->metadata->readPreference);
        self::assertSame([[]], $this->metadata->readPreferenceTags);
    }

    public function testLifecycle(): void
    {
        $this->givenBuilder()->lifecycle()->prePersist('callback');

        $this->builder->build($this->metadata);

        self::assertSameArray(['prePersist' => ['callback']], $this->metadata->lifecycleCallbacks);
    }

    public function testAlsoLoadMethod(): void
    {
        $this->givenBuilder()->alsoLoad('populateFirstAndLastName', ['name', 'fullName']);

        $this->builder->build($this->metadata);

        self::assertSameArray([
            'populateFirstAndLastName' => ['name', 'fullName']
        ], $this->metadata->alsoLoadMethods);
    }
}
