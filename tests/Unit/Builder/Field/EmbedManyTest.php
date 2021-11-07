<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field;

use yjiotpukc\MongoODMFluent\Builder\Field\EmbedManyBuilder;
use yjiotpukc\MongoODMFluent\Tests\Stubs\CollectionStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\AnotherEntityStub;

class EmbedManyTest extends FieldTestCase
{
    public static function getDefaultMapping(): array
    {
        return [
            'association' => 4,
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
            'notSaved' => false,
            'strategy' => 'pushAll',
            'type' => 'many',
        ];
    }

    public static function getDefaultFieldName(): string
    {
        return 'address';
    }

    public function testEmbedMany()
    {
        $this->givenDefaultBuilder();

        $this->assertFieldBuildsCorrectly();
    }

    protected function givenDefaultBuilder(): EmbedManyBuilder
    {
        return $this->givenBuilder('address', AnotherEntityStub::class);
    }

    protected function givenBuilder(string $fieldName, string $target = ''): EmbedManyBuilder
    {
        $this->builder = new EmbedManyBuilder($fieldName, $target);

        return $this->builder;
    }

    public function testEmbedManyWithTarget()
    {
        $this->givenBuilder('address')->target(AnotherEntityStub::class);

        $this->assertFieldBuildsCorrectly();
    }

    public function testEmbedManyWithoutTarget()
    {
        $this->givenBuilder('address');

        $this->assertFieldBuildsCorrectly(
            ['discriminatorField' => '_doctrine_class_name'],
            'address',
            ['targetDocument']
        );
    }

    public function testNullableEmbedMany()
    {
        $this->givenDefaultBuilder()->nullable();

        $this->assertFieldBuildsCorrectly(['nullable' => true]);
    }

    public function testNotSavedEmbedMany()
    {
        $this->givenDefaultBuilder()->notSaved();

        $this->assertFieldBuildsCorrectly(['notSaved' => true]);
    }

    public function testReferenceOneWithDiscriminator()
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

    public function testEmbedManyWithCollectionClass()
    {
        $this->givenDefaultBuilder()->collectionClass(CollectionStub::class);

        $this->assertFieldBuildsCorrectly(['collectionClass' => CollectionStub::class]);
    }

    public function testEmbedManyWithCollectionStrategy()
    {
        $this->givenDefaultBuilder()->strategy()->setArray();

        $this->assertFieldBuildsCorrectly(['strategy' => 'setArray']);
    }
}
