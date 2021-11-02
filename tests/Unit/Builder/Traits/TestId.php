<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Traits;

use yjiotpukc\MongoODMFluent\Tests\Stubs\IdGeneratorStub;

trait TestId
{
    public function testDefaultId()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->id();
        $builder->build($metadata);

        $this->assertIdFieldMappingIsCorrect([], $metadata->fieldMappings['id']);
    }

    public function testUuidId()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->id()->uuid();
        $builder->build($metadata);

        $this->assertIdFieldMappingIsCorrect([
            'strategy' => 'uuid',
            'type' => 'custom_id',
        ], $metadata->fieldMappings['id']);
    }

    public function testAlphaNumericId()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->id()->alNum();
        $builder->build($metadata);

        $this->assertIdFieldMappingIsCorrect([
            'strategy' => 'alNum',
            'type' => 'custom_id',
        ], $metadata->fieldMappings['id']);
    }

    public function testIncrementId()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->id()->increment();
        $builder->build($metadata);
        $this->assertIdFieldMappingIsCorrect([
            'strategy' => 'increment',
            'type' => 'int',
        ], $metadata->fieldMappings['id']);
    }

    public function testNoneId()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->id()->none();
        $builder->build($metadata);

        $this->assertIdFieldMappingIsCorrect([
            'strategy' => 'none',
            'type' => 'custom_id',
        ], $metadata->fieldMappings['id']);
    }

    public function testCustomId()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->id()->custom(IdGeneratorStub::class);
        $builder->build($metadata);

        $this->assertIdFieldMappingIsCorrect([
            'strategy' => 'custom',
            'options' => ['class' => IdGeneratorStub::class],
            'type' => 'custom_id',
        ], $metadata->fieldMappings['id']);
    }

    public function testAlphaNumericStringId()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->id()->alNum()->type('string');
        $builder->build($metadata);

        $this->assertIdFieldMappingIsCorrect([
            'strategy' => 'alNum',
            'type' => 'string',
        ], $metadata->fieldMappings['id']);
    }

    protected function assertIdFieldMappingIsCorrect(array $overwriteFields, array $fieldMapping)
    {
        $defaultFields = [
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
            'nullable' => false,
            'isOwningSide' => true,
            'isInverseSide' => false,
        ];

        $this->assertFieldMappingIsCorrect($defaultFields, $overwriteFields, $fieldMapping);
    }
}
