<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Traits;

use yjiotpukc\MongoODMFluent\Tests\Stubs\CollectionStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\AnotherEntityStub;
use yjiotpukc\MongoODMFluent\Type\Cascade;
use yjiotpukc\MongoODMFluent\Type\CollectionStrategy;
use yjiotpukc\MongoODMFluent\Type\Discriminator;

trait TestReferenceMany
{
    public function testReferenceMany()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceMany('address', AnotherEntityStub::class);
        $builder->build($metadata);

        $this->assertReferenceManyFieldMappingIsCorrect([], $metadata->fieldMappings['address']);
    }

    public function testReferenceManyWithTarget()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceMany('address')->target(AnotherEntityStub::class);
        $builder->build($metadata);

        $this->assertReferenceManyFieldMappingIsCorrect([], $metadata->fieldMappings['address']);
    }

    public function testReferenceManyWithoutTarget()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceMany('address');
        $builder->build($metadata);

        $this->assertReferenceManyFieldMappingIsCorrect(
            ['discriminatorField' => '_doctrine_class_name'],
            $metadata->fieldMappings['address'],
            ['targetDocument']
        );
    }

    public function testReferenceManyAsDbRef()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceMany('address', AnotherEntityStub::class)->storeAsDbRef();
        $builder->build($metadata);

        $this->assertReferenceManyFieldMappingIsCorrect([], $metadata->fieldMappings['address']);
    }

    public function testReferenceManyAsDbRefWithDb()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceMany('address', AnotherEntityStub::class)->storeAsDbRefWithDb();
        $builder->build($metadata);

        $this->assertReferenceManyFieldMappingIsCorrect(
            ['storeAs' => 'dbRefWithDb'],
            $metadata->fieldMappings['address']
        );
    }

    public function testReferenceManyAsRef()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceMany('address', AnotherEntityStub::class)->storeAsRef();
        $builder->build($metadata);

        $this->assertReferenceManyFieldMappingIsCorrect(
            ['storeAs' => 'ref'],
            $metadata->fieldMappings['address']
        );
    }

    public function testReferenceManyAsId()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceMany('address', AnotherEntityStub::class)->storeAsId();
        $builder->build($metadata);

        $this->assertReferenceManyFieldMappingIsCorrect(
            ['storeAs' => 'id'],
            $metadata->fieldMappings['address']
        );
    }

    public function testNullableReferenceMany()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceMany('address', AnotherEntityStub::class)->nullable();
        $builder->build($metadata);

        $this->assertReferenceManyFieldMappingIsCorrect(
            ['nullable' => true],
            $metadata->fieldMappings['address']
        );
    }

    public function testNotSavedReferenceMany()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceMany('address', AnotherEntityStub::class)->notSaved();
        $builder->build($metadata);

        $this->assertReferenceManyFieldMappingIsCorrect(
            ['notSaved' => true],
            $metadata->fieldMappings['address']
        );
    }

    public function testReferenceManyWithOrphanRemoval()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceMany('address', AnotherEntityStub::class)->orphanRemoval();
        $builder->build($metadata);

        $this->assertReferenceManyFieldMappingIsCorrect(
            ['orphanRemoval' => true],
            $metadata->fieldMappings['address']
        );
    }

    /**
     * @dataProvider cascadeProvider
     */
    public function testReferenceManyWithCascadeAll(Cascade $cascade, array $expectedFields)
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceMany('address', AnotherEntityStub::class)->cascade($cascade);
        $builder->build($metadata);

        $this->assertReferenceManyFieldMappingIsCorrect(
            $expectedFields,
            $metadata->fieldMappings['address']
        );
    }

    public function testReferenceManyWithRepositoryMethod()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceMany('address', AnotherEntityStub::class)->repositoryMethod('getAddresses');
        $builder->build($metadata);

        $this->assertReferenceManyFieldMappingIsCorrect([
            'isInverseSide' => true,
            'isOwningSide' => false,
            'repositoryMethod' => 'getAddresses',
        ], $metadata->fieldMappings['address']);
    }

    public function testReferenceManyWithSkip()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceMany('address', AnotherEntityStub::class)->skip(4);
        $builder->build($metadata);

        $this->assertReferenceManyFieldMappingIsCorrect(
            ['skip' => 4],
            $metadata->fieldMappings['address']
        );
    }

    public function testReferenceManyWithLimit()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceMany('address', AnotherEntityStub::class)->limit(5);
        $builder->build($metadata);

        $this->assertReferenceManyFieldMappingIsCorrect(
            ['limit' => 5],
            $metadata->fieldMappings['address']
        );
    }

    public function testReferenceManyWithMappedBy()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceMany('address', AnotherEntityStub::class)->mappedBy('user_id');
        $builder->build($metadata);

        $this->assertReferenceManyFieldMappingIsCorrect([
            'isInverseSide' => true,
            'isOwningSide' => false,
            'mappedBy' => 'user_id',
        ], $metadata->fieldMappings['address']);
    }

    public function testReferenceManyWithInversedBy()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceMany('address', AnotherEntityStub::class)->inversedBy('address_id');
        $builder->build($metadata);

        $this->assertReferenceManyFieldMappingIsCorrect(
            ['inversedBy' => 'address_id'],
            $metadata->fieldMappings['address']
        );
    }

    /**
     * @dataProvider discriminatorProvider
     */
    public function testReferenceManyWithDiscriminator(Discriminator $discriminator, array $expectedFields)
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceMany('address', AnotherEntityStub::class)->discriminator($discriminator);
        $builder->build($metadata);

        $this->assertReferenceManyFieldMappingIsCorrect(
            $expectedFields,
            $metadata->fieldMappings['address']
        );
    }

    public function testReferenceManyWithSortDefault()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceMany('address', AnotherEntityStub::class)
            ->strategy((new CollectionStrategy())->setArray())
            ->addSort('sort');
        $builder->build($metadata);

        $this->assertReferenceManyFieldMappingIsCorrect([
            'strategy' => 'setArray',
            'sort' => ['sort' => 'asc'],
        ], $metadata->fieldMappings['address']);
    }

    public function testReferenceManyWithSortAsc()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceMany('address', AnotherEntityStub::class)
            ->strategy((new CollectionStrategy())->setArray())
            ->addSort('sort', 'asc');
        $builder->build($metadata);

        $this->assertReferenceManyFieldMappingIsCorrect([
            'strategy' => 'setArray',
            'sort' => ['sort' => 'asc'],
        ], $metadata->fieldMappings['address']);
    }

    public function testReferenceManyWithSortDesc()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceMany('address', AnotherEntityStub::class)
            ->strategy((new CollectionStrategy())->setArray())
            ->addSort('sort', 'desc');
        $builder->build($metadata);

        $this->assertReferenceManyFieldMappingIsCorrect([
            'strategy' => 'setArray',
            'sort' => ['sort' => 'desc'],
        ], $metadata->fieldMappings['address']);
    }

    public function testReferenceManyWithMultiSort()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceMany('address', AnotherEntityStub::class)
            ->strategy((new CollectionStrategy())->setArray())
            ->addSort('sort', 'desc')
            ->addSort('id');
        $builder->build($metadata);

        $this->assertReferenceManyFieldMappingIsCorrect([
            'strategy' => 'setArray',
            'sort' => [
                'sort' => 'desc',
                'id' => 'asc',
            ],
        ], $metadata->fieldMappings['address']);
    }

    public function testReferenceManyWithCriteria()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceMany('address', AnotherEntityStub::class)->addCriteria('type', 'physical');
        $builder->build($metadata);

        $this->assertReferenceManyFieldMappingIsCorrect(
            ['criteria' => ['type' => 'physical']],
            $metadata->fieldMappings['address']
        );
    }

    public function testReferenceManyWithMultiCriteria()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceMany('address', AnotherEntityStub::class)->addCriteria('type', 'physical')->addCriteria('name', 'home');
        $builder->build($metadata);

        $this->assertReferenceManyFieldMappingIsCorrect([
            'criteria' => [
                'type' => 'physical',
                'name' => 'home',
            ],
        ], $metadata->fieldMappings['address']);
    }

    /**
     * @dataProvider collectionStrategyProvider
     */
    public function testReferenceManyWithCollectionStrategy(CollectionStrategy $strategy, array $expectedFields)
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceMany('address', AnotherEntityStub::class)->strategy($strategy);
        $builder->build($metadata);

        $this->assertReferenceManyFieldMappingIsCorrect(
            $expectedFields,
            $metadata->fieldMappings['address']
        );
    }

    public function testReferenceManyWithCollectionClass()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceMany('address', AnotherEntityStub::class)->collectionClass(CollectionStub::class);
        $builder->build($metadata);

        $this->assertReferenceManyFieldMappingIsCorrect(
            ['collectionClass' => CollectionStub::class],
            $metadata->fieldMappings['address']
        );
    }

    public function testReferenceManyWithPrime()
    {
        $builder = $this->givenEmptyBuilder();
        $metadata = $this->givenClassMetadata();

        $builder->referenceMany('address', AnotherEntityStub::class)
            ->mappedBy('user_id')
            ->addPrime('type');
        $builder->build($metadata);

        $this->assertReferenceManyFieldMappingIsCorrect(
            [
                'isInverseSide' => true,
                'isOwningSide' => false,
                'mappedBy' => 'user_id',
                'prime' => ['type'],
            ],
            $metadata->fieldMappings['address']
        );
    }

    protected function assertReferenceManyFieldMappingIsCorrect(array $overwriteFields, array $fieldMapping, array $deleteFields = [])
    {
        $defaultFields = [
            'name' => 'address',
            'fieldName' => 'address',
            'targetDocument' => AnotherEntityStub::class,
            'association' => 2,
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
            'prime' => [],
            'sort' => [],
            'storeAs' => 'dbRef',
            'strategy' => 'pushAll',
            'type' => 'many',
        ];

        $this->assertFieldMappingIsCorrect($defaultFields, $overwriteFields, $fieldMapping, $deleteFields);
    }
}
