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
        $this->builder->referenceMany('address', AnotherEntityStub::class);

        $this->assertReferenceManyWasBuiltCorrectly([]);
    }

    public function testReferenceManyWithTarget()
    {
        $this->builder->referenceMany('address')->target(AnotherEntityStub::class);

        $this->assertReferenceManyWasBuiltCorrectly([]);
    }

    public function testReferenceManyWithoutTarget()
    {
        $this->builder->referenceMany('address');

        $this->assertReferenceManyWasBuiltCorrectly(
            ['discriminatorField' => '_doctrine_class_name'],
            ['targetDocument']
        );
    }

    public function testReferenceManyAsDbRef()
    {
        $this->builder->referenceMany('address', AnotherEntityStub::class)->storeAsDbRef();

        $this->assertReferenceManyWasBuiltCorrectly([]);
    }

    public function testReferenceManyAsDbRefWithDb()
    {
        $this->builder->referenceMany('address', AnotherEntityStub::class)->storeAsDbRefWithDb();

        $this->assertReferenceManyWasBuiltCorrectly(['storeAs' => 'dbRefWithDb']);
    }

    public function testReferenceManyAsRef()
    {
        $this->builder->referenceMany('address', AnotherEntityStub::class)->storeAsRef();

        $this->assertReferenceManyWasBuiltCorrectly(['storeAs' => 'ref']);
    }

    public function testReferenceManyAsId()
    {
        $this->builder->referenceMany('address', AnotherEntityStub::class)->storeAsId();

        $this->assertReferenceManyWasBuiltCorrectly(['storeAs' => 'id']);
    }

    public function testNullableReferenceMany()
    {
        $this->builder->referenceMany('address', AnotherEntityStub::class)->nullable();

        $this->assertReferenceManyWasBuiltCorrectly(['nullable' => true]);
    }

    public function testNotSavedReferenceMany()
    {
        $this->builder->referenceMany('address', AnotherEntityStub::class)->notSaved();

        $this->assertReferenceManyWasBuiltCorrectly(['notSaved' => true]);
    }

    public function testReferenceManyWithOrphanRemoval()
    {
        $this->builder->referenceMany('address', AnotherEntityStub::class)->orphanRemoval();

        $this->assertReferenceManyWasBuiltCorrectly(['orphanRemoval' => true]);
    }

    /**
     * @dataProvider cascadeProvider
     */
    public function testReferenceManyWithCascadeAll(Cascade $cascade, array $expectedFields)
    {
        $this->builder->referenceMany('address', AnotherEntityStub::class)->cascade($cascade);

        $this->assertReferenceManyWasBuiltCorrectly($expectedFields);
    }

    public function testReferenceManyWithRepositoryMethod()
    {
        $this->builder->referenceMany('address', AnotherEntityStub::class)->repositoryMethod('getAddresses');

        $this->assertReferenceManyWasBuiltCorrectly([
            'isInverseSide' => true,
            'isOwningSide' => false,
            'repositoryMethod' => 'getAddresses',
        ]);
    }

    public function testReferenceManyWithSkip()
    {
        $this->builder->referenceMany('address', AnotherEntityStub::class)->skip(4);

        $this->assertReferenceManyWasBuiltCorrectly(['skip' => 4]);
    }

    public function testReferenceManyWithLimit()
    {
        $this->builder->referenceMany('address', AnotherEntityStub::class)->limit(5);

        $this->assertReferenceManyWasBuiltCorrectly(['limit' => 5]);
    }

    public function testReferenceManyWithMappedBy()
    {
        $this->builder->referenceMany('address', AnotherEntityStub::class)->mappedBy('user_id');

        $this->assertReferenceManyWasBuiltCorrectly([
            'isInverseSide' => true,
            'isOwningSide' => false,
            'mappedBy' => 'user_id',
        ]);
    }

    public function testReferenceManyWithInversedBy()
    {
        $this->builder->referenceMany('address', AnotherEntityStub::class)->inversedBy('address_id');

        $this->assertReferenceManyWasBuiltCorrectly(['inversedBy' => 'address_id']);
    }

    /**
     * @dataProvider discriminatorProvider
     */
    public function testReferenceManyWithDiscriminator(Discriminator $discriminator, array $expectedFields)
    {
        $this->builder->referenceMany('address', AnotherEntityStub::class)->discriminator($discriminator);

        $this->assertReferenceManyWasBuiltCorrectly($expectedFields);
    }

    public function testReferenceManyWithSortDefault()
    {
        $this->builder
            ->referenceMany('address', AnotherEntityStub::class)
            ->strategy((new CollectionStrategy())->setArray())
            ->addSort('sort');

        $this->assertReferenceManyWasBuiltCorrectly([
            'strategy' => 'setArray',
            'sort' => ['sort' => 'asc'],
        ]);
    }

    public function testReferenceManyWithSortAsc()
    {
        $this->builder
            ->referenceMany('address', AnotherEntityStub::class)
            ->strategy((new CollectionStrategy())->setArray())
            ->addSort('sort', 'asc');

        $this->assertReferenceManyWasBuiltCorrectly([
            'strategy' => 'setArray',
            'sort' => ['sort' => 'asc'],
        ]);
    }

    public function testReferenceManyWithSortDesc()
    {
        $this->builder
            ->referenceMany('address', AnotherEntityStub::class)
            ->strategy((new CollectionStrategy())->setArray())
            ->addSort('sort', 'desc');

        $this->assertReferenceManyWasBuiltCorrectly([
            'strategy' => 'setArray',
            'sort' => ['sort' => 'desc'],
        ]);
    }

    public function testReferenceManyWithMultiSort()
    {
        $this->builder
            ->referenceMany('address', AnotherEntityStub::class)
            ->strategy((new CollectionStrategy())->setArray())
            ->addSort('sort', 'desc')
            ->addSort('id');

        $this->assertReferenceManyWasBuiltCorrectly([
            'strategy' => 'setArray',
            'sort' => [
                'sort' => 'desc',
                'id' => 'asc',
            ],
        ]);
    }

    public function testReferenceManyWithCriteria()
    {
        $this->builder->referenceMany('address', AnotherEntityStub::class)->addCriteria('type', 'physical');

        $this->assertReferenceManyWasBuiltCorrectly(['criteria' => ['type' => 'physical']]);
    }

    public function testReferenceManyWithMultiCriteria()
    {
        $this->builder
            ->referenceMany('address', AnotherEntityStub::class)
            ->addCriteria('type', 'physical')
            ->addCriteria('name', 'home');

        $this->assertReferenceManyWasBuiltCorrectly([
            'criteria' => [
                'type' => 'physical',
                'name' => 'home',
            ],
        ]);
    }

    /**
     * @dataProvider collectionStrategyProvider
     */
    public function testReferenceManyWithCollectionStrategy(CollectionStrategy $strategy, array $expectedFields)
    {
        $this->builder
            ->referenceMany('address', AnotherEntityStub::class)
            ->strategy($strategy);

        $this->assertReferenceManyWasBuiltCorrectly($expectedFields);
    }

    public function testReferenceManyWithCollectionClass()
    {
        $this->builder
            ->referenceMany('address', AnotherEntityStub::class)
            ->collectionClass(CollectionStub::class);

        $this->assertReferenceManyWasBuiltCorrectly(['collectionClass' => CollectionStub::class]);
    }

    public function testReferenceManyWithPrime()
    {
        $this->builder->referenceMany('address', AnotherEntityStub::class)
            ->mappedBy('user_id')
            ->addPrime('type');

        $this->assertReferenceManyWasBuiltCorrectly([
            'isInverseSide' => true,
            'isOwningSide' => false,
            'mappedBy' => 'user_id',
            'prime' => ['type'],
        ]);
    }

    protected function assertReferenceManyWasBuiltCorrectly(array $expectedFields, array $deleteFields = [])
    {
        $this->builder->build($this->metadata);

        $this->assertFieldMappingIsCorrect(
            $this->getReferenceManyDefaultMapping(),
            $expectedFields,
            $this->metadata->fieldMappings['address'],
            $deleteFields
        );
    }

    protected function getReferenceManyDefaultMapping(): array
    {
        return [
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
    }
}
