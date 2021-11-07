<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field;

use yjiotpukc\MongoODMFluent\Builder\Field\IdBuilder;
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

    public function testNullableId()
    {
        $this->givenBuilder()->nullable();

        $this->assertFieldBuildsCorrectly(['nullable' => true]);
    }

    public function testNotSavedId()
    {
        $this->givenBuilder()->notSaved();

        $this->assertFieldBuildsCorrectly(['notSaved' => true]);
    }

    protected function givenBuilder(): IdBuilder
    {
        $this->builder = new IdBuilder();

        return $this->builder;
    }

    public static function getDefaultFieldName(): string
    {
        return 'id';
    }

    public static function getDefaultMapping(): array
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
            'notSaved' => false,
        ];
    }
}
