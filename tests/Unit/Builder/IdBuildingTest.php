<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder;

use yjiotpukc\MongoODMFluent\Builder\Document\MappedSuperclassBuilder;

class IdBuildingTest extends BuilderBaseTestCase
{
    public function testDefaultId()
    {
        $this->builder->id();
        $this->assertIdWasBuiltCorrectly([]);
    }

    public function givenEmptyBuilder(): MappedSuperclassBuilder
    {
        return new MappedSuperclassBuilder();
    }

    protected function assertIdWasBuiltCorrectly(array $expectedFields)
    {
        $this->builder->build($this->metadata);

        $this->assertFieldMappingIsCorrect(
            $this->getDefaultMapping(),
            $expectedFields,
            $this->metadata->fieldMappings['id']
        );
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
}
