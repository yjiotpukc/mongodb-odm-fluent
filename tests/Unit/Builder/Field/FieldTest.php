<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field;

use yjiotpukc\MongoODMFluent\Builder\Field\Field;

class FieldTest extends FieldTestCase
{
    public function testStringField()
    {
        $this->givenDefaultBuilder();

        $this->assertFieldBuildsCorrectly();
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

    protected function getDefaultMapping(): array
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

    protected function getDefaultFieldName(): string
    {
        return 'firstName';
    }

    protected function givenDefaultBuilder(): Field
    {
        return $this->givenBuilder('string', 'firstName');
    }

    protected function givenBuilder(string $type, string $fieldName): Field
    {
        $this->builder = new Field($type, $fieldName);

        return $this->builder;
    }
}
