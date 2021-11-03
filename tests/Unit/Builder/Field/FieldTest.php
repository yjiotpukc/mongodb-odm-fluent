<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field;

use yjiotpukc\MongoODMFluent\Builder\Field\Field;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\BuilderTestCase;

class FieldTest extends BuilderTestCase
{
    public function testStringField()
    {
        $this->givenDefaultBuilder();

        $this->assertFieldWasBuiltCorrectly([]);
    }

    public function testIntegerField()
    {
        $this->givenBuilder('integer', 'age');

        $this->assertFieldWasBuiltCorrectly([
            'fieldName' => 'age',
            'name' => 'age',
            'type' => 'integer',
        ], 'age');
    }

    public function testNullableStringField()
    {
        $this->givenDefaultBuilder()->nullable();

        $this->assertFieldWasBuiltCorrectly(['nullable' => true]);
    }

    public function testNotSavedStringField()
    {
        $this->givenDefaultBuilder()->notSaved();

        $this->assertFieldWasBuiltCorrectly(['notSaved' => true]);
    }

    public function testStringFieldWithDifferentNameInDb()
    {
        $this->givenDefaultBuilder()->nameInDb('name');

        $this->assertFieldWasBuiltCorrectly(['name' => 'name']);
    }

    protected function assertFieldWasBuiltCorrectly(array $expectedFields, string $fieldName = 'firstName')
    {
        $this->builder->build($this->metadata);

        $this->assertFieldMappingIsCorrect(
            $this->getFieldDefaultMapping(),
            $expectedFields,
            $this->metadata->fieldMappings[$fieldName]
        );
    }

    protected function getFieldDefaultMapping(): array
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
