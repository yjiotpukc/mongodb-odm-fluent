<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Field\FileMetadataBuilder;
use yjiotpukc\MongoODMFluent\Tests\Stubs\AnotherEntityStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\FileStub;

class FileMetadataTest extends FieldTestCase
{
    public static function getDefaultFieldName(): string
    {
        return 'metadata';
    }

    public static function getDefaultMapping(): array
    {
        return [
            'association' => 3,
            'embedded' => true,
            'fieldName' => 'metadata',
            'targetDocument' => AnotherEntityStub::class,
            'isCascadeDetach' => true,
            'isCascadeMerge' => true,
            'isCascadePersist' => true,
            'isCascadeRefresh' => true,
            'isCascadeRemove' => true,
            'isInverseSide' => false,
            'isOwningSide' => true,
            'name' => 'metadata',
            'nullable' => false,
            'notSaved' => false,
            'strategy' => 'set',
            'type' => 'one',
        ];
    }

    public function testFileMetadata(): void
    {
        $this->givenDefaultBuilder();

        $this->assertFieldBuildsCorrectly();
    }

    protected function givenDefaultBuilder(): FileMetadataBuilder
    {
        return $this->givenBuilder()->target(AnotherEntityStub::class);
    }

    protected function givenBuilder(): FileMetadataBuilder
    {
        $this->builder = new FileMetadataBuilder();

        return $this->builder;
    }

    public function testFileMetadataWithFieldName(): void
    {
        $this->givenDefaultBuilder()->fieldName('metadataCustom');

        $this->assertFieldBuildsCorrectly(['fieldName' => 'metadataCustom'], 'metadataCustom');
    }

    public function testReferenceOneWithDiscriminator(): void
    {
        $this->givenBuilder()
            ->discriminator('type')
            ->default('physical')
            ->map('physical', AnotherEntityStub::class);

        $this->assertFieldBuildsCorrectly([
            'targetDocument' => null,
            'discriminatorField' => 'type',
            'defaultDiscriminatorValue' => 'physical',
            'discriminatorMap' => ['physical' => AnotherEntityStub::class],
        ]);
    }

    public function givenClassMetadata(): ClassMetadata
    {
        $this->metadata = new ClassMetadata(FileStub::class);

        return $this->metadata;
    }
}
