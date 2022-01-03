<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field;

use yjiotpukc\MongoODMFluent\Builder\Field\FieldBuilder;

class FieldTest extends FieldTestCase
{
    public static function getDefaultFieldName(): string
    {
        return 'firstName';
    }

    public static function getDefaultMapping(): array
    {
        return [
            'fieldName' => 'firstName',
            'name' => 'firstName',
            'type' => 'string',
            'notSaved' => false,
            'strategy' => 'set',
            'nullable' => false,
            'isCascadeRemove' => false,
            'isCascadePersist' => false,
            'isCascadeRefresh' => false,
            'isCascadeMerge' => false,
            'isCascadeDetach' => false,
            'isOwningSide' => true,
            'isInverseSide' => false,
        ];
    }

    public function testStringField(): void
    {
        $this->givenDefaultBuilder();

        $this->assertFieldBuildsCorrectly();
    }

    protected function givenDefaultBuilder(): FieldBuilder
    {
        return $this->givenBuilder('string', 'firstName');
    }

    protected function givenBuilder(string $type, string $fieldName): FieldBuilder
    {
        $this->builder = new FieldBuilder($type, $fieldName);

        return $this->builder;
    }

    public function testIntegerField(): void
    {
        $this->givenBuilder('int', 'age');

        $this->assertFieldBuildsCorrectly([
            'fieldName' => 'age',
            'name' => 'age',
            'type' => 'int',
        ], 'age');
    }

    public function testNullableStringField(): void
    {
        $this->givenDefaultBuilder()->nullable();

        $this->assertFieldBuildsCorrectly(['nullable' => true]);
    }

    public function testNotSavedStringField(): void
    {
        $this->givenDefaultBuilder()->notSaved();

        $this->assertFieldBuildsCorrectly(['notSaved' => true]);
    }

    public function testStringFieldWithDifferentNameInDb(): void
    {
        $this->givenDefaultBuilder()->nameInDb('name');

        $this->assertFieldBuildsCorrectly(['name' => 'name']);
    }

    public function testAutoincrementField(): void
    {
        $this->givenBuilder('int', 'age')->increment();

        $this->assertFieldBuildsCorrectly([
            'fieldName' => 'age',
            'name' => 'age',
            'type' => 'int',
            'strategy' => 'increment'
        ], 'age');
    }

    public function testOptimisticLocking(): void
    {
        $this->givenBuilder('int', 'age')->version();

        $this->assertFieldBuildsCorrectly([
            'fieldName' => 'age',
            'name' => 'age',
            'type' => 'int',
            'version' => true,
            'notSaved' => true,
        ], 'age');
    }

    public function testPessimisticLocking(): void
    {
        $this->givenBuilder('int', 'age')->lock();

        $this->assertFieldBuildsCorrectly([
            'fieldName' => 'age',
            'name' => 'age',
            'type' => 'int',
            'lock' => true,
            'notSaved' => true,
        ], 'age');
    }

    public function testAlsoLoadFields(): void
    {
        $this->givenDefaultBuilder()->alsoLoad('name');

        $this->assertFieldBuildsCorrectly(['alsoLoadFields' => ['name']]);
    }
}
