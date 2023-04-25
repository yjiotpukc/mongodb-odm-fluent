<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Document;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\FileBuilder;
use yjiotpukc\MongoODMFluent\Tests\Stubs\AnotherEntityStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\FileStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\RepositoryStub;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\BuilderTestCase;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field\FieldTest;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field\IdTest;

class FileBuilderTest extends BuilderTestCase
{
    protected FileBuilder $builder;

    public function testDb(): void
    {
        $this->givenBuilder()->db('dbName');

        $this->builder->build($this->metadata);

        self::assertSame('dbName', $this->metadata->db);
    }

    protected function givenBuilder(): FileBuilder
    {
        $this->builder = new FileBuilder();

        return $this->builder;
    }

    public function testBucket(): void
    {
        $this->givenBuilder()->bucket('images');

        $this->builder->build($this->metadata);

        self::assertSame('images', $this->metadata->getBucketName());
    }

    public function testIndex(): void
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

    public function testTwoIndexes(): void
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

    public function testRepository(): void
    {
        $this->givenBuilder()->repository(RepositoryStub::class);
        $this->builder->build($this->metadata);

        self::assertSame(RepositoryStub::class, $this->metadata->customRepositoryClassName);
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

    public function testChunkSize(): void
    {
        $this->givenBuilder()->chunkSize(100000);

        $this->builder->build($this->metadata);

        self::assertSame(100000, $this->metadata->getChunkSizeBytes());
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

    public function testId(): void
    {
        $this->givenBuilder()->id();
        $this->builder->build($this->metadata);

        self::assertSameArray(
            IdTest::getDefaultMapping(),
            $this->metadata->fieldMappings[IdTest::getDefaultFieldName()]
        );
    }

    public function testFilenameFieldName(): void
    {
        $this->givenBuilder()->filenameFieldName('filenameCustom');

        $this->builder->build($this->metadata);

        $this->assertFieldBuildsCorrectly('filenameCustom',
            [
                'fieldName' => 'filenameCustom',
                'name' => 'filename',
                'notSaved' => true,
            ]
        );
    }

    protected function assertFieldBuildsCorrectly(string $fieldName, array $expectedFields = []): void
    {
        $this->builder->build($this->metadata);

        $expectedFields = array_merge(FieldTest::getDefaultMapping(), $expectedFields);
        $fieldMapping = $this->metadata->fieldMappings[$fieldName];

        self::assertSameArray($expectedFields, $fieldMapping);
    }

    public function testUploadDateFieldName(): void
    {
        $this->givenBuilder()->uploadDateFieldName('uploadDateCustom');

        $this->builder->build($this->metadata);

        $this->assertFieldBuildsCorrectly('uploadDateCustom',
            [
                'fieldName' => 'uploadDateCustom',
                'name' => 'uploadDate',
                'type' => 'date',
                'notSaved' => true,
            ]
        );
    }

    public function testLengthFieldName(): void
    {
        $this->givenBuilder()->lengthFieldName('lengthCustom');

        $this->builder->build($this->metadata);

        $this->assertFieldBuildsCorrectly('lengthCustom',
            [
                'fieldName' => 'lengthCustom',
                'name' => 'length',
                'type' => 'int',
                'notSaved' => true,
            ]
        );
    }

    public function testChunkSizeFieldName(): void
    {
        $this->givenBuilder()->chunkSizeFieldName('chunkSizeCustom');

        $this->builder->build($this->metadata);

        $this->assertFieldBuildsCorrectly('chunkSizeCustom',
            [
                'fieldName' => 'chunkSizeCustom',
                'name' => 'chunkSize',
                'type' => 'int',
                'notSaved' => true,
            ]
        );
    }

    public function testMetadata(): void
    {
        $this->givenBuilder()->metadata()->target(AnotherEntityStub::class);

        $this->builder->build($this->metadata);

        $this->assertFieldBuildsCorrectly('metadata',
            [
                'association' => 3,
                'embedded' => true,
                'type' => 'one',
                'fieldName' => 'metadata',
                'targetDocument' => AnotherEntityStub::class,
                'name' => 'metadata',
                'isCascadeDetach' => true,
                'isCascadeMerge' => true,
                'isCascadePersist' => true,
                'isCascadeRefresh' => true,
                'isCascadeRemove' => true,
                'defaultDiscriminatorValue' => null,
                'discriminatorField' => null,
                'discriminatorMap' => null,
            ]
        );
    }

    public function givenClassMetadata(): ClassMetadata
    {
        $this->metadata = new ClassMetadata(FileStub::class);

        return $this->metadata;
    }
}
