<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Traits;

trait TestField
{
    public function testStringField()
    {
        $this->builder->field('string', 'firstName');

        $this->assertFieldWasBuiltCorrectly([]);
    }

    public function testIntegerField()
    {
        $this->builder->field('integer', 'age');

        $this->assertFieldWasBuiltCorrectly([
            'fieldName' => 'age',
            'name' => 'age',
            'type' => 'integer',
        ], 'age');
    }

    public function testNullableStringField()
    {
        $this->builder->field('string', 'firstName')->nullable();

        $this->assertFieldWasBuiltCorrectly(['nullable' => true]);
    }

    public function testNotSavedStringField()
    {
        $this->builder->field('string', 'firstName')->notSaved();

        $this->assertFieldWasBuiltCorrectly(['notSaved' => true]);
    }

    public function testStringFieldWithDifferentNameInDb()
    {
        $this->builder->field('string', 'firstName')->nameInDb('name');

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
}
