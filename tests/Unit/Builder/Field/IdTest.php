<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field;

use yjiotpukc\MongoODMFluent\Builder\Field\IdBuilder;

class IdTest extends FieldTestCase
{
    public static function getDefaultFieldName(): string
    {
        return 'id';
    }

    public static function getDefaultMapping(): array
    {
        return [
            'id' => true,
            'fieldName' => 'id',
            'strategy' => 'auto',
            'name' => '_id',
            'isCascadeRemove' => false,
            'isCascadePersist' => false,
            'isCascadeRefresh' => false,
            'isCascadeMerge' => false,
            'isCascadeDetach' => false,
            'type' => 'id',
            'options' => [],
            'nullable' => false,
            'isOwningSide' => true,
            'isInverseSide' => false,
            'notSaved' => false,
            'value' => null,
        ];
    }

    public function testDefaultId(): void
    {
        $this->givenBuilder();

        $this->assertFieldBuildsCorrectly();
    }

    protected function givenBuilder(): IdBuilder
    {
        $this->builder = new IdBuilder();

        return $this->builder;
    }

    public function testIdWithFieldName(): void
    {
        $this->givenBuilder()->fieldName('firstName');

        $this->assertFieldBuildsCorrectly(['fieldName' => 'firstName'], 'firstName');
    }

    public function testUuidId(): void
    {
        $this->givenBuilder()->uuid();

        $this->assertFieldBuildsCorrectly([
            'strategy' => 'uuid',
            'type' => 'custom_id',
            'options' => [],
        ]);
    }

    public function testAlphaNumericId(): void
    {
        $this->givenBuilder()->alNum();

        $this->assertFieldBuildsCorrectly([
            'strategy' => 'alNum',
            'type' => 'custom_id',
            'options' => ['awkwardSafe' => false],
        ]);
    }

    public function testIncrementId(): void
    {
        $this->givenBuilder()->increment();

        $this->assertFieldBuildsCorrectly([
            'strategy' => 'increment',
            'type' => 'int',
            'options' => ['startingId' => 1],
        ]);
    }

    public function testNoneId(): void
    {
        $this->givenBuilder()->none();

        $this->assertFieldBuildsCorrectly([
            'strategy' => 'none',
            'type' => 'custom_id',
        ]);
    }

    public function testCustomId(): void
    {
        $this->givenBuilder()->custom('IdGeneratorClassName');

        $this->assertFieldBuildsCorrectly([
            'strategy' => 'custom',
            'options' => ['class' => 'IdGeneratorClassName'],
            'type' => 'custom_id',
        ]);
    }

    public function testAlphaNumericStringId(): void
    {
        $this->givenBuilder()->alNum()->type('string');

        $this->assertFieldBuildsCorrectly([
            'strategy' => 'alNum',
            'type' => 'string',
            'options' => ['awkwardSafe' => false],
        ]);
    }

    public function testIncrementIdWithStartingId(): void
    {
        $this->givenBuilder()->increment()->startingId(10);

        $this->assertFieldBuildsCorrectly([
            'strategy' => 'increment',
            'type' => 'int',
            'options' => ['startingId' => 10],
        ]);
    }

    public function testIncrementIdWithKey(): void
    {
        $this->givenBuilder()->increment()->key('increment_key');

        $this->assertFieldBuildsCorrectly([
            'strategy' => 'increment',
            'type' => 'int',
            'options' => [
                'startingId' => 1,
                'key' => 'increment_key',
            ],
        ]);
    }

    public function testIncrementIdWithCollection(): void
    {
        $this->givenBuilder()->increment()->collection('increment_collection');

        $this->assertFieldBuildsCorrectly([
            'strategy' => 'increment',
            'type' => 'int',
            'options' => [
                'startingId' => 1,
                'collection' => 'increment_collection',
            ],
        ]);
    }

    public function testAlphaNumericIdWithPadding(): void
    {
        $this->givenBuilder()->alNum()->pad(4);

        $this->assertFieldBuildsCorrectly([
            'strategy' => 'alNum',
            'type' => 'custom_id',
            'options' => [
                'awkwardSafe' => false,
                'pad' => 4,
            ],
        ]);
    }

    public function testAlphaNumericIdWithChars(): void
    {
        $this->givenBuilder()->alNum()->chars('abcdef');

        $this->assertFieldBuildsCorrectly([
            'strategy' => 'alNum',
            'type' => 'custom_id',
            'options' => [
                'awkwardSafe' => false,
                'chars' => 'abcdef',
            ],
        ]);
    }

    public function testAlphaNumericIdWithAwkwardSafeMode(): void
    {
        $this->givenBuilder()->alNum()->awkwardSafeMode();

        $this->assertFieldBuildsCorrectly([
            'strategy' => 'alNum',
            'type' => 'custom_id',
            'options' => ['awkwardSafe' => true],
        ]);
    }

    public function testUuidIdWithSalt(): void
    {
        $this->givenBuilder()->uuid()->salt('salty');

        $this->assertFieldBuildsCorrectly([
            'strategy' => 'uuid',
            'type' => 'custom_id',
            'options' => ['salt' => 'salty'],
        ]);
    }

    public function testCustomIdWithGeneratorOptions(): void
    {
        $this->givenBuilder()->custom('IdGeneratorClassName')->generatorOption('key', 'value');

        $this->assertFieldBuildsCorrectly([
            'strategy' => 'custom',
            'type' => 'custom_id',
            'options' => [
                'key' => 'value',
                'class' => 'IdGeneratorClassName',
            ],
        ]);
    }

    public function testNullableId(): void
    {
        $this->givenBuilder()->nullable();

        $this->assertFieldBuildsCorrectly(['nullable' => true]);
    }

    public function testNotSavedId(): void
    {
        $this->givenBuilder()->notSaved();

        $this->assertFieldBuildsCorrectly(['notSaved' => true]);
    }
}
