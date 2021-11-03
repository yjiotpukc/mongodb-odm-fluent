<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field;

use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\BuilderTestCase;

abstract class FieldTestCase extends BuilderTestCase
{
    abstract protected function getDefaultMapping(): array;

    abstract protected function getDefaultFieldName(): string;

    protected function assertFieldBuildsCorrectly(array $expectedFields = [], string $fieldName = '', array $withoutFields = [])
    {
        $this->builder->build($this->metadata);

        if (empty($fieldName)) {
            $fieldName = $this->getDefaultFieldName();
        }
        $fieldMapping = $this->metadata->fieldMappings[$fieldName];

        $expectedFields = array_merge($this->getDefaultMapping(), $expectedFields);
        foreach ($withoutFields as $deleteField) {
            unset($expectedFields[$deleteField]);
        }

        self::assertSameArray($expectedFields, $fieldMapping);
    }
}
