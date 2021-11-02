<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Traits;

use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\AnotherEntityStub;
use yjiotpukc\MongoODMFluent\Type\Cascade;
use yjiotpukc\MongoODMFluent\Type\Discriminator;

trait TestReferenceOne
{
    public function testReferenceOne()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceOne('address', AnotherEntityStub::class);
        $builder->build($metadata);

        $this->assertReferenceOneFieldMappingIsCorrect([
            'name' => 'address',
            'fieldName' => 'address',
            'targetDocument' => AnotherEntityStub::class,
        ], $metadata->fieldMappings['address']);
    }

    public function testReferenceOneWithTarget()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceOne('address')->target(AnotherEntityStub::class);
        $builder->build($metadata);

        $this->assertReferenceOneFieldMappingIsCorrect([
            'name' => 'address',
            'fieldName' => 'address',
            'targetDocument' => AnotherEntityStub::class,
        ], $metadata->fieldMappings['address']);
    }

    public function testReferenceOneWithoutTarget()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceOne('address');
        $builder->build($metadata);

        $this->assertReferenceOneFieldMappingIsCorrect([
            'name' => 'address',
            'fieldName' => 'address',
            'discriminatorField' => '_doctrine_class_name',
        ], $metadata->fieldMappings['address']);
    }

    public function testReferenceOneAsDbRef()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceOne('address', AnotherEntityStub::class)->storeAsDbRef();
        $builder->build($metadata);

        $this->assertReferenceOneFieldMappingIsCorrect([
            'name' => 'address',
            'fieldName' => 'address',
            'targetDocument' => AnotherEntityStub::class,
        ], $metadata->fieldMappings['address']);
    }

    public function testReferenceOneAsDbRefWithDb()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceOne('address', AnotherEntityStub::class)->storeAsDbRefWithDb();
        $builder->build($metadata);

        $this->assertReferenceOneFieldMappingIsCorrect([
            'name' => 'address',
            'fieldName' => 'address',
            'targetDocument' => AnotherEntityStub::class,
            'storeAs' => 'dbRefWithDb',
        ], $metadata->fieldMappings['address']);
    }

    public function testReferenceOneAsRef()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceOne('address', AnotherEntityStub::class)->storeAsRef();
        $builder->build($metadata);

        $this->assertReferenceOneFieldMappingIsCorrect([
            'name' => 'address',
            'fieldName' => 'address',
            'targetDocument' => AnotherEntityStub::class,
            'storeAs' => 'ref',
        ], $metadata->fieldMappings['address']);
    }

    public function testReferenceOneAsId()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceOne('address', AnotherEntityStub::class)->storeAsId();
        $builder->build($metadata);

        $this->assertReferenceOneFieldMappingIsCorrect([
            'name' => 'address',
            'fieldName' => 'address',
            'targetDocument' => AnotherEntityStub::class,
            'storeAs' => 'id',
        ], $metadata->fieldMappings['address']);
    }

    public function testNullableReferenceOne()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceOne('address', AnotherEntityStub::class)->nullable();
        $builder->build($metadata);

        $this->assertReferenceOneFieldMappingIsCorrect([
            'name' => 'address',
            'fieldName' => 'address',
            'targetDocument' => AnotherEntityStub::class,
            'nullable' => true,
        ], $metadata->fieldMappings['address']);
    }

    public function testNotSavedReferenceOne()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceOne('address', AnotherEntityStub::class)->notSaved();
        $builder->build($metadata);

        $this->assertReferenceOneFieldMappingIsCorrect([
            'name' => 'address',
            'fieldName' => 'address',
            'targetDocument' => AnotherEntityStub::class,
            'notSaved' => true,
        ], $metadata->fieldMappings['address']);
    }

    public function testReferenceOneWithOrphanRemoval()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceOne('address', AnotherEntityStub::class)->orphanRemoval();
        $builder->build($metadata);

        $this->assertReferenceOneFieldMappingIsCorrect([
            'name' => 'address',
            'fieldName' => 'address',
            'targetDocument' => AnotherEntityStub::class,
            'orphanRemoval' => true,
        ], $metadata->fieldMappings['address']);
    }

    /**
     * @dataProvider cascadeProvider
     */
    public function testReferenceOneWithCascadeAll(Cascade $cascade, array $expectedFields)
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceOne('address', AnotherEntityStub::class)->cascade($cascade);
        $builder->build($metadata);

        $this->assertReferenceOneFieldMappingIsCorrect(
            array_merge(
                [
                    'name' => 'address',
                    'fieldName' => 'address',
                    'targetDocument' => AnotherEntityStub::class,
                ],
                $expectedFields
            ),
            $metadata->fieldMappings['address']
        );
    }

    public function testReferenceOneWithRepositoryMethod()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceOne('address', AnotherEntityStub::class)->repositoryMethod('getAddresses');
        $builder->build($metadata);

        $this->assertReferenceOneFieldMappingIsCorrect([
            'name' => 'address',
            'fieldName' => 'address',
            'targetDocument' => AnotherEntityStub::class,
            'isInverseSide' => true,
            'isOwningSide' => false,
            'repositoryMethod' => 'getAddresses',
        ], $metadata->fieldMappings['address']);
    }

    public function testReferenceOneWithSkip()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceOne('address', AnotherEntityStub::class)->skip(4);
        $builder->build($metadata);

        $this->assertReferenceOneFieldMappingIsCorrect([
            'name' => 'address',
            'fieldName' => 'address',
            'targetDocument' => AnotherEntityStub::class,
            'skip' => 4,
        ], $metadata->fieldMappings['address']);
    }

    public function testReferenceOneWithMappedBy()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceOne('address', AnotherEntityStub::class)->mappedBy('user_id');
        $builder->build($metadata);

        $this->assertReferenceOneFieldMappingIsCorrect([
            'name' => 'address',
            'fieldName' => 'address',
            'targetDocument' => AnotherEntityStub::class,
            'isInverseSide' => true,
            'isOwningSide' => false,
            'mappedBy' => 'user_id',
        ], $metadata->fieldMappings['address']);
    }

    public function testReferenceOneWithInversedBy()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceOne('address', AnotherEntityStub::class)->inversedBy('address_id');
        $builder->build($metadata);

        $this->assertReferenceOneFieldMappingIsCorrect([
            'name' => 'address',
            'fieldName' => 'address',
            'targetDocument' => AnotherEntityStub::class,
            'inversedBy' => 'address_id',
        ], $metadata->fieldMappings['address']);
    }

    /**
     * @dataProvider discriminatorProvider
     */
    public function testReferenceOneWithDiscriminator(Discriminator $discriminator, array $expectedFields)
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceOne('address', AnotherEntityStub::class)->discriminator($discriminator);
        $builder->build($metadata);

        $this->assertReferenceOneFieldMappingIsCorrect(
            array_merge(
                [
                    'name' => 'address',
                    'fieldName' => 'address',
                    'targetDocument' => AnotherEntityStub::class,
                    'defaultDiscriminatorValue' => null,
                    'discriminatorField' => 'type',
                    'discriminatorMap' => null,
                ],
                $expectedFields
            ),
            $metadata->fieldMappings['address']
        );
    }

    public function testReferenceOneWithSortDefault()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceOne('address', AnotherEntityStub::class)->addSort('sort');
        $builder->build($metadata);

        $this->assertReferenceOneFieldMappingIsCorrect([
            'name' => 'address',
            'fieldName' => 'address',
            'targetDocument' => AnotherEntityStub::class,
            'sort' => ['sort' => 'asc'],
        ], $metadata->fieldMappings['address']);
    }

    public function testReferenceOneWithSortAsc()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceOne('address', AnotherEntityStub::class)->addSort('sort', 'asc');
        $builder->build($metadata);

        $this->assertReferenceOneFieldMappingIsCorrect([
            'name' => 'address',
            'fieldName' => 'address',
            'targetDocument' => AnotherEntityStub::class,
            'sort' => ['sort' => 'asc'],
        ], $metadata->fieldMappings['address']);
    }

    public function testReferenceOneWithSortDesc()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceOne('address', AnotherEntityStub::class)->addSort('sort', 'desc');
        $builder->build($metadata);

        $this->assertReferenceOneFieldMappingIsCorrect([
            'name' => 'address',
            'fieldName' => 'address',
            'targetDocument' => AnotherEntityStub::class,
            'sort' => ['sort' => 'desc'],
        ], $metadata->fieldMappings['address']);
    }

    public function testReferenceOneWithMultiSort()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceOne('address', AnotherEntityStub::class)->addSort('sort', 'desc')->addSort('id');
        $builder->build($metadata);

        $this->assertReferenceOneFieldMappingIsCorrect([
            'name' => 'address',
            'fieldName' => 'address',
            'targetDocument' => AnotherEntityStub::class,
            'sort' => [
                'sort' => 'desc',
                'id' => 'asc',
            ],
        ], $metadata->fieldMappings['address']);
    }

    public function testReferenceOneWithCriteria()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceOne('address', AnotherEntityStub::class)->addCriteria('type', 'physical');
        $builder->build($metadata);

        $this->assertReferenceOneFieldMappingIsCorrect([
            'name' => 'address',
            'fieldName' => 'address',
            'targetDocument' => AnotherEntityStub::class,
            'criteria' => ['type' => 'physical'],
        ], $metadata->fieldMappings['address']);
    }

    public function testReferenceOneWithMultiCriteria()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceOne('address', AnotherEntityStub::class)->addCriteria('type', 'physical')->addCriteria('name', 'home');
        $builder->build($metadata);

        $this->assertReferenceOneFieldMappingIsCorrect([
            'name' => 'address',
            'fieldName' => 'address',
            'targetDocument' => AnotherEntityStub::class,
            'criteria' => [
                'type' => 'physical',
                'name' => 'home',
            ],
        ], $metadata->fieldMappings['address']);
    }

    public function cascadeProvider(): array
    {
        return [
            [
                (new Cascade())->all(),
                [
                    'cascade' => [
                        'detach',
                        'merge',
                        'refresh',
                        'remove',
                        'persist',
                    ],
                    'isCascadeDetach' => true,
                    'isCascadeMerge' => true,
                    'isCascadePersist' => true,
                    'isCascadeRefresh' => true,
                    'isCascadeRemove' => true,
                ],
            ],
            [
                (new Cascade())->detach(),
                [
                    'cascade' => [
                        'detach',
                    ],
                    'isCascadeDetach' => true,
                ],
            ],
            [
                (new Cascade())->merge(),
                [
                    'cascade' => [
                        'merge',
                    ],
                    'isCascadeMerge' => true,
                ],
            ],
            [
                (new Cascade())->persist(),
                [
                    'cascade' => [
                        'persist',
                    ],
                    'isCascadePersist' => true,
                ],
            ],
            [
                (new Cascade())->refresh(),
                [
                    'cascade' => [
                        'refresh',
                    ],
                    'isCascadeRefresh' => true,
                ],
            ],
            [
                (new Cascade())->remove(),
                [
                    'cascade' => [
                        'remove',
                    ],
                    'isCascadeRemove' => true,
                ],
            ],
        ];
    }

    public function discriminatorProvider(): array
    {
        return [
            [
                new Discriminator('type'),
                [
                    'defaultDiscriminatorValue' => null,
                    'discriminatorField' => 'type',
                    'discriminatorMap' => null,
                ],
            ],
            [
                (new Discriminator('type'))->default('physical'),
                [
                    'defaultDiscriminatorValue' => 'physical',
                    'discriminatorField' => 'type',
                    'discriminatorMap' => null,
                ],
            ],
            [
                (new Discriminator('type'))
                    ->map('email', AnotherEntityStub::class)
                    ->map('physical', AnotherEntityStub::class),
                [
                    'defaultDiscriminatorValue' => null,
                    'discriminatorField' => 'type',
                    'discriminatorMap' => [
                        'email' => AnotherEntityStub::class,
                        'physical' => AnotherEntityStub::class,
                    ],
                ],
            ],
        ];
    }

    protected function assertReferenceOneFieldMappingIsCorrect(array $overwriteFields, array $fieldMapping)
    {
        $defaultFields = [
            'association' => 1,
            'criteria' => [],
            'isCascadeDetach' => false,
            'isCascadeMerge' => false,
            'isCascadePersist' => false,
            'isCascadeRefresh' => false,
            'isCascadeRemove' => false,
            'isInverseSide' => false,
            'isOwningSide' => true,
            'notSaved' => false,
            'nullable' => false,
            'orphanRemoval' => false,
            'reference' => true,
            'sort' => [],
            'storeAs' => 'dbRef',
            'strategy' => 'set',
            'type' => 'one',
        ];

        $this->assertFieldMappingIsCorrect($defaultFields, $overwriteFields, $fieldMapping);
    }
}
