<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field;

use yjiotpukc\MongoODMFluent\Builder\Field\Id;
use yjiotpukc\MongoODMFluent\Tests\Stubs\IdGeneratorStub;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\BuilderBaseTestCase;

class IdTest extends BuilderBaseTestCase
{
    public function testDefaultId()
    {
        $this->givenBuilder();

        $this->assertIdWasBuiltCorrectly([]);
    }

    public function testUuidId()
    {
        $this->givenBuilder()->uuid();

        $this->assertIdWasBuiltCorrectly([
            'strategy' => 'uuid',
            'type' => 'custom_id',
        ]);
    }

    public function testAlphaNumericId()
    {
        $this->givenBuilder()->alNum();

        $this->assertIdWasBuiltCorrectly([
            'strategy' => 'alNum',
            'type' => 'custom_id',
        ]);
    }

    public function testIncrementId()
    {
        $this->givenBuilder()->increment();

        $this->assertIdWasBuiltCorrectly([
            'strategy' => 'increment',
            'type' => 'int',
        ]);
    }

    public function testNoneId()
    {
        $this->givenBuilder()->none();

        $this->assertIdWasBuiltCorrectly([
            'strategy' => 'none',
            'type' => 'custom_id',
        ]);
    }

    public function testCustomId()
    {
        $this->givenBuilder()->custom(IdGeneratorStub::class);

        $this->assertIdWasBuiltCorrectly([
            'strategy' => 'custom',
            'options' => ['class' => IdGeneratorStub::class],
            'type' => 'custom_id',
        ]);
    }

    public function testAlphaNumericStringId()
    {
        $this->givenBuilder()->alNum()->type('string');

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

    protected function givenBuilder(): Id
    {
        $this->builder = new Id();

        return $this->builder;
    }
}
