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

        $this->assertFieldFieldMappingIsCorrect([], $metadata->fieldMappings['firstName']);
    }

    public function testIntegerField()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->field('integer', 'age');
        $builder->build($metadata);

        $this->assertFieldFieldMappingIsCorrect([
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

        $this->assertFieldFieldMappingIsCorrect(
            ['nullable' => true],
            $metadata->fieldMappings['firstName']
        );
    }

    public function testNotSavedStringField()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->field('string', 'firstName')->notSaved();
        $builder->build($metadata);

        $this->assertFieldFieldMappingIsCorrect(
            ['notSaved' => true],
            $metadata->fieldMappings['firstName']
        );
    }

    public function testStringFieldWithDifferentNameInDb()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->field('string', 'firstName')->nameInDb('name');
        $builder->build($metadata);

        $this->assertFieldFieldMappingIsCorrect(
            ['name' => 'name'],
            $metadata->fieldMappings['firstName']
        );
    }

    protected function assertFieldFieldMappingIsCorrect(array $overwriteFields, array $fieldMapping)
    {
        $defaultFields = [
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

        $this->assertFieldMappingIsCorrect($defaultFields, $overwriteFields, $fieldMapping);
    }
}
