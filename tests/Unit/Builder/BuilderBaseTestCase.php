<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use PHPUnit\Framework\TestCase;
use yjiotpukc\MongoODMFluent\Tests\Stubs\EntityStub;

abstract class BuilderBaseTestCase extends TestCase
{
    abstract public function givenEmptyBuilder();

    public function givenBuilderWithId()
    {
        $builder = $this->givenEmptyBuilder();
        $builder->id();

        return $builder;
    }

    public function givenBuilderWithSomeFields()
    {
        $builder = $this->givenEmptyBuilder();
        $builder->field('string', 'firstName');
        $builder->field('string', 'lastName');
        $builder->field('int', 'age');

        return $builder;
    }

    public function givenClassMetadata(): ClassMetadata
    {
        return new ClassMetadata(EntityStub::class);
    }

    protected function assertFieldMappingIsCorrect(array $defaultFields, array $overwriteFields, array $fieldMapping)
    {
        $expectedFields = array_merge($defaultFields, $overwriteFields);

        ksort($expectedFields);
        ksort($fieldMapping);

        static::assertSame($expectedFields, $fieldMapping);
    }
}
