<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field;

use yjiotpukc\MongoODMFluent\Builder\Field\Id;
use yjiotpukc\MongoODMFluent\Tests\Stubs\IdGeneratorStub;

class IdTest extends FieldTestCase
{
    public function testDefaultId()
    {
        $this->givenBuilder();

        $this->assertFieldBuildsCorrectly();
    }

    public function testUuidId()
    {
        $this->givenBuilder()->uuid();

        $this->assertFieldBuildsCorrectly([
            'strategy' => 'uuid',
            'type' => 'custom_id',
        ]);
    }

    public function testAlphaNumericId()
    {
        $this->givenBuilder()->alNum();

        $this->assertFieldBuildsCorrectly([
            'strategy' => 'alNum',
            'type' => 'custom_id',
        ]);
    }

    public function testIncrementId()
    {
        $this->givenBuilder()->increment();

        $this->assertFieldBuildsCorrectly([
            'strategy' => 'increment',
            'type' => 'int',
        ]);
    }

    public function testNoneId()
    {
        $this->givenBuilder()->none();

        $this->assertFieldBuildsCorrectly([
            'strategy' => 'none',
            'type' => 'custom_id',
        ]);
    }

    public function testCustomId()
    {
        $this->givenBuilder()->custom(IdGeneratorStub::class);

        $this->assertFieldBuildsCorrectly([
            'strategy' => 'custom',
            'options' => ['class' => IdGeneratorStub::class],
            'type' => 'custom_id',
        ]);
    }

    public function testAlphaNumericStringId()
    {
        $this->givenBuilder()->alNum()->type('string');

        $this->assertFieldBuildsCorrectly([
            'strategy' => 'alNum',
            'type' => 'string',
        ]);
    }

    protected function getDefaultMapping(): array
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

    protected function getDefaultFieldName(): string
    {
        return 'id';
    }

    protected function givenBuilder(): Id
    {
        $this->builder = new Id();

        return $this->builder;
    }
}
