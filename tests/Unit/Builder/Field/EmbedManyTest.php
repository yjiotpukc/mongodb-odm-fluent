<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field;

use yjiotpukc\MongoODMFluent\Builder\Field\EmbedBuilder;
use yjiotpukc\MongoODMFluent\Tests\Stubs\AnotherEntityStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\CollectionStub;

class EmbedManyTest extends FieldTestCase
{
    public static function getDefaultFieldName(): string
    {
        return 'address';
    }

    public static function getDefaultMapping(): array
    {
        return [
            'association' => 4,
            'collectionClass' => null,
            'defaultDiscriminatorValue' => null,
            'discriminatorField' => null,
            'discriminatorMap' => null,
            'embedded' => true,
            'fieldName' => 'address',
            'targetDocument' => AnotherEntityStub::class,
            'isCascadeDetach' => true,
            'isCascadeMerge' => true,
            'isCascadePersist' => true,
            'isCascadeRefresh' => true,
            'isCascadeRemove' => true,
            'isInverseSide' => false,
            'isOwningSide' => true,
            'name' => 'address',
            'nullable' => false,
            'options' => [],
            'notSaved' => false,
            'strategy' => 'pushAll',
            'type' => 'many',
            'value' => null,
        ];
    }

    public function testEmbedMany(): void
    {
        $this->givenDefaultBuilder();

        $this->assertFieldBuildsCorrectly();
    }

    protected function givenDefaultBuilder(): EmbedBuilder
    {
        return $this->givenBuilder('address', AnotherEntityStub::class);
    }

    protected function givenBuilder(string $fieldName, string $target = ''): EmbedBuilder
    {
        $this->builder = EmbedBuilder::many($fieldName, $target);

        return $this->builder;
    }

    public function testEmbedManyWithTarget(): void
    {
        $this->givenBuilder('address')->target(AnotherEntityStub::class);

        $this->assertFieldBuildsCorrectly();
    }

    public function testEmbedManyWithoutTarget(): void
    {
        $this->givenBuilder('address');

        $this->assertFieldBuildsCorrectly(
            ['discriminatorField' => '_doctrine_class_name'],
            'address',
            ['targetDocument']
        );
    }

    public function testNullableEmbedMany(): void
    {
        $this->givenDefaultBuilder()->nullable();

        $this->assertFieldBuildsCorrectly(['nullable' => true]);
    }

    public function testNotSavedEmbedMany(): void
    {
        $this->givenDefaultBuilder()->notSaved();

        $this->assertFieldBuildsCorrectly(['notSaved' => true]);
    }

    public function testReferenceOneWithDiscriminator(): void
    {
        $this->givenDefaultBuilder()
            ->discriminator('type')
            ->default('physical')
            ->map('physical', AnotherEntityStub::class);

        $this->assertFieldBuildsCorrectly([
            'discriminatorField' => 'type',
            'defaultDiscriminatorValue' => 'physical',
            'discriminatorMap' => ['physical' => AnotherEntityStub::class],
        ]);
    }

    public function testEmbedManyWithCollectionClass(): void
    {
        $this->givenDefaultBuilder()->collectionClass(CollectionStub::class);

        $this->assertFieldBuildsCorrectly(['collectionClass' => CollectionStub::class]);
    }

    public function testEmbedManyWithCollectionStrategy(): void
    {
        $this->givenDefaultBuilder()->strategy()->setArray();

        $this->assertFieldBuildsCorrectly(['strategy' => 'setArray']);
    }
}
