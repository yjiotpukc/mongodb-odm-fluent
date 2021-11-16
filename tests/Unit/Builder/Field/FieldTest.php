<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field;

use yjiotpukc\MongoODMFluent\Builder\Field\FieldBuilder;

class FieldTest extends FieldTestCase
{
    public function testStringField()
    {
        $this->givenDefaultBuilder();

        $this->assertFieldBuildsCorrectly();
    }

    public function testIntegerField()
    {
        $this->givenBuilder('int', 'age');

        $this->assertFieldBuildsCorrectly([
            'fieldName' => 'age',
            'name' => 'age',
            'type' => 'int',
        ], 'age');
    }

    public function testNullableStringField()
    {
        $this->givenDefaultBuilder()->nullable();

        $this->assertFieldBuildsCorrectly(['nullable' => true]);
    }

    public function testNotSavedStringField()
    {
        $this->givenDefaultBuilder()->notSaved();

        $this->assertFieldBuildsCorrectly(['notSaved' => true]);
    }

    public function testStringFieldWithDifferentNameInDb()
    {
        $this->givenDefaultBuilder()->nameInDb('name');

        $this->assertFieldBuildsCorrectly(['name' => 'name']);
    }

    public function testAutoincrementField()
    {
        $this->givenBuilder('int', 'age')->increment();

        $this->assertFieldBuildsCorrectly([
            'fieldName' => 'age',
            'name' => 'age',
            'type' => 'int',
            'strategy' => 'increment'
        ], 'age');
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
}
