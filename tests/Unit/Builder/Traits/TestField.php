<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Traits;

trait TestField
{
    public function testStringField()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->field('string', 'firstName');
        $builder->build($metadata);

        $this->assertFieldMappingIsCorrect([
            'fieldName' => 'firstName',
            'name' => 'firstName',
            'type' => 'string',
        ], $metadata->fieldMappings['firstName']);
    }

    public function testIntegerField()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->field('integer', 'age');
        $builder->build($metadata);

        $this->assertFieldMappingIsCorrect([
            'fieldName' => 'age',
            'name' => 'age',
            'type' => 'integer',
        ], $metadata->fieldMappings['age']);
    }

    public function testNullableStringField()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->field('string', 'firstName')->nullable();
        $builder->build($metadata);

        $this->assertFieldMappingIsCorrect([
            'fieldName' => 'firstName',
            'name' => 'firstName',
            'type' => 'string',
            'nullable' => true,
        ], $metadata->fieldMappings['firstName']);
    }

    public function testNotSavedStringField()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->field('string', 'firstName')->notSaved();
        $builder->build($metadata);

        $this->assertFieldMappingIsCorrect([
            'fieldName' => 'firstName',
            'name' => 'firstName',
            'type' => 'string',
            'notSaved' => true,
        ], $metadata->fieldMappings['firstName']);
    }

    public function testStringFieldWithDifferentNameInDb()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->field('string', 'firstName')->nameInDb('name');
        $builder->build($metadata);

        $this->assertFieldMappingIsCorrect([
            'fieldName' => 'firstName',
            'name' => 'name',
            'type' => 'string',
        ], $metadata->fieldMappings['firstName']);
    }

    protected function assertFieldMappingIsCorrect(array $overwriteFields, array $fieldMapping)
    {
        $expectedFields = array_merge([
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
        ], $overwriteFields);

        ksort($expectedFields);
        ksort($fieldMapping);

        static::assertSame($expectedFields, $fieldMapping);
    }
}
