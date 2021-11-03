<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Traits;

use yjiotpukc\MongoODMFluent\Tests\Stubs\IdGeneratorStub;

trait TestId
{
    public function testDefaultId()
    {
        $this->builder->id();

        $this->assertIdWasBuiltCorrectly([]);
    }

    public function testUuidId()
    {
        $this->builder->id()->uuid();

        $this->assertIdWasBuiltCorrectly([
            'strategy' => 'uuid',
            'type' => 'custom_id',
        ]);
    }

    public function testAlphaNumericId()
    {
        $this->builder->id()->alNum();

        $this->assertIdWasBuiltCorrectly([
            'strategy' => 'alNum',
            'type' => 'custom_id',
        ]);
    }

    public function testIncrementId()
    {
        $this->builder->id()->increment();

        $this->assertIdWasBuiltCorrectly([
            'strategy' => 'increment',
            'type' => 'int',
        ]);
    }

    public function testNoneId()
    {
        $this->builder->id()->none();

        $this->assertIdWasBuiltCorrectly([
            'strategy' => 'none',
            'type' => 'custom_id',
        ]);
    }

    public function testCustomId()
    {
        $this->builder->id()->custom(IdGeneratorStub::class);

        $this->assertIdWasBuiltCorrectly([
            'strategy' => 'custom',
            'options' => ['class' => IdGeneratorStub::class],
            'type' => 'custom_id',
        ]);
    }

    public function testAlphaNumericStringId()
    {
        $this->builder->id()->alNum()->type('string');

        $this->assertIdWasBuiltCorrectly([
            'strategy' => 'alNum',
            'type' => 'string',
        ]);
    }

    protected function assertIdWasBuiltCorrectly(array $expectedFields)
    {
        $this->builder->build($this->metadata);

        $this->assertFieldMappingIsCorrect(
            $this->getIdDefaultMapping(),
            $expectedFields,
            $this->metadata->fieldMappings['id']
        );
    }

    protected function getIdDefaultMapping(): array
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
            'nullable' => false,
            'isOwningSide' => true,
            'isInverseSide' => false,
        ];
    }
}
