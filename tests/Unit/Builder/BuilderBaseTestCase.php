<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use PHPUnit\Framework\TestCase;
use yjiotpukc\MongoODMFluent\Tests\Stubs\EntityStub;

abstract class BuilderBaseTestCase extends TestCase
{
    protected $builder;
    protected $metadata;

    protected function setUp(): void
    {
        parent::setUp();
        $this->givenClassMetadata();
    }

    public function givenClassMetadata(): ClassMetadata
    {
        $this->metadata = new ClassMetadata(EntityStub::class);

        return $this->metadata;
    }

    protected function assertFieldMappingIsCorrect(array $defaultFields, array $overwriteFields, array $fieldMapping, array $deleteFields = [])
    {
        $expectedFields = array_merge($defaultFields, $overwriteFields);
        foreach ($deleteFields as $deleteField) {
            unset($expectedFields[$deleteField]);
        }

        ksort($expectedFields);
        ksort($fieldMapping);

        static::assertSame($expectedFields, $fieldMapping);
    }
}
