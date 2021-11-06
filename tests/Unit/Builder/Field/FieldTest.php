<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field;

use yjiotpukc\MongoODMFluent\Builder\Field\FieldBuilder;

class FieldTest extends FieldTestCase
{
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

    public static function getDefaultFieldName(): string
    {
        return 'firstName';
    }

    public function testStringField()
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

    public function testIntegerField()
    {
        $this->givenBuilder('integer', 'age');

        $this->assertFieldBuildsCorrectly([
            'fieldName' => 'age',
            'name' => 'age',
            'type' => 'integer',
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
}
