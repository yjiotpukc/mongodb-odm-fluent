<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field;

use yjiotpukc\MongoODMFluent\Builder\Builder;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\BuilderTestCase;

abstract class FieldTestCase extends BuilderTestCase
{
    protected Builder $builder;

    protected function assertFieldBuildsCorrectly(array $expectedFields = [], string $fieldName = '', array $withoutFields = []): void
    {
        $this->builder->build($this->metadata);

        if (empty($fieldName)) {
            $fieldName = static::getDefaultFieldName();
        }
        $fieldMapping = $this->metadata->fieldMappings[$fieldName];

        $expectedFields = array_merge(static::getDefaultMapping(), $expectedFields);
        foreach ($withoutFields as $deleteField) {
            unset($expectedFields[$deleteField]);
        }

        self::assertSameArray($expectedFields, $fieldMapping);
    }

    abstract public static function getDefaultFieldName(): string;

    abstract public static function getDefaultMapping(): array;
}
