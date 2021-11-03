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
        $this->builder->referenceOne('address', AnotherEntityStub::class);

        $this->assertReferenceOneWasBuiltCorrectly([]);
    }

    public function testReferenceOneWithTarget()
    {
        $this->builder->referenceOne('address')->target(AnotherEntityStub::class);

        $this->assertReferenceOneWasBuiltCorrectly([]);
    }

    public function testReferenceOneWithoutTarget()
    {
        $this->builder->referenceOne('address');

        $this->assertReferenceOneWasBuiltCorrectly(
            ['discriminatorField' => '_doctrine_class_name'],
            ['targetDocument']
        );
    }

    public function testReferenceOneAsDbRef()
    {
        $this->builder->referenceOne('address', AnotherEntityStub::class)->storeAsDbRef();

        $this->assertReferenceOneWasBuiltCorrectly([]);
    }

    public function testReferenceOneAsDbRefWithDb()
    {
        $this->builder->referenceOne('address', AnotherEntityStub::class)->storeAsDbRefWithDb();

        $this->assertReferenceOneWasBuiltCorrectly(['storeAs' => 'dbRefWithDb']);
    }

    public function testReferenceOneAsRef()
    {
        $this->builder->referenceOne('address', AnotherEntityStub::class)->storeAsRef();

        $this->assertReferenceOneWasBuiltCorrectly(['storeAs' => 'ref']);
    }

    public function testReferenceOneAsId()
    {
        $this->builder->referenceOne('address', AnotherEntityStub::class)->storeAsId();

        $this->assertReferenceOneWasBuiltCorrectly(['storeAs' => 'id']);
    }

    public function testNullableReferenceOne()
    {
        $this->builder->referenceOne('address', AnotherEntityStub::class)->nullable();

        $this->assertReferenceOneWasBuiltCorrectly(['nullable' => true]);
    }

    public function testNotSavedReferenceOne()
    {
        $this->builder->referenceOne('address', AnotherEntityStub::class)->notSaved();

        $this->assertReferenceOneWasBuiltCorrectly(['notSaved' => true]);
    }

    public function testReferenceOneWithOrphanRemoval()
    {
        $this->builder->referenceOne('address', AnotherEntityStub::class)->orphanRemoval();

        $this->assertReferenceOneWasBuiltCorrectly(['orphanRemoval' => true]);
    }

    /**
     * @dataProvider cascadeProvider
     */
    public function testReferenceOneWithCascadeAll(Cascade $cascade, array $expectedFields)
    {
        $this->builder->referenceOne('address', AnotherEntityStub::class)->cascade($cascade);

        $this->assertReferenceOneWasBuiltCorrectly($expectedFields);
    }

    public function testReferenceOneWithRepositoryMethod()
    {
        $this->builder->referenceOne('address', AnotherEntityStub::class)->repositoryMethod('getAddresses');

        $this->assertReferenceOneWasBuiltCorrectly([
            'isInverseSide' => true,
            'isOwningSide' => false,
            'repositoryMethod' => 'getAddresses',
        ]);
    }

    public function testReferenceOneWithSkip()
    {
        $this->builder->referenceOne('address', AnotherEntityStub::class)->skip(4);

        $this->assertReferenceOneWasBuiltCorrectly(['skip' => 4]);
    }

    public function testReferenceOneWithMappedBy()
    {
        $this->builder->referenceOne('address', AnotherEntityStub::class)->mappedBy('user_id');

        $this->assertReferenceOneWasBuiltCorrectly([
            'isInverseSide' => true,
            'isOwningSide' => false,
            'mappedBy' => 'user_id',
        ]);
    }

    public function testReferenceOneWithInversedBy()
    {
        $this->builder->referenceOne('address', AnotherEntityStub::class)->inversedBy('address_id');

        $this->assertReferenceOneWasBuiltCorrectly(['inversedBy' => 'address_id']);
    }

    /**
     * @dataProvider discriminatorProvider
     */
    public function testReferenceOneWithDiscriminator(Discriminator $discriminator, array $expectedFields)
    {
        $this->builder->referenceOne('address', AnotherEntityStub::class)->discriminator($discriminator);

        $this->assertReferenceOneWasBuiltCorrectly($expectedFields);
    }

    public function testReferenceOneWithSortDefault()
    {
        $this->builder->referenceOne('address', AnotherEntityStub::class)->addSort('sort');

        $this->assertReferenceOneWasBuiltCorrectly(['sort' => ['sort' => 'asc']]);
    }

    public function testReferenceOneWithSortAsc()
    {
        $this->builder->referenceOne('address', AnotherEntityStub::class)->addSort('sort', 'asc');

        $this->assertReferenceOneWasBuiltCorrectly(['sort' => ['sort' => 'asc']]);
    }

    public function testReferenceOneWithSortDesc()
    {
        $this->builder->referenceOne('address', AnotherEntityStub::class)->addSort('sort', 'desc');

        $this->assertReferenceOneWasBuiltCorrectly(['sort' => ['sort' => 'desc']]);
    }

    public function testReferenceOneWithMultiSort()
    {
        $this->builder
            ->referenceOne('address', AnotherEntityStub::class)
            ->addSort('sort', 'desc')
            ->addSort('id');

        $this->assertReferenceOneWasBuiltCorrectly([
            'sort' => [
                'sort' => 'desc',
                'id' => 'asc',
            ],
        ]);
    }

    public function testReferenceOneWithCriteria()
    {
        $this->builder
            ->referenceOne('address', AnotherEntityStub::class)
            ->addCriteria('type', 'physical');

        $this->assertReferenceOneWasBuiltCorrectly(['criteria' => ['type' => 'physical']]);
    }

    public function testReferenceOneWithMultiCriteria()
    {
        $this->builder
            ->referenceOne('address', AnotherEntityStub::class)
            ->addCriteria('type', 'physical')
            ->addCriteria('name', 'home');

        $this->assertReferenceOneWasBuiltCorrectly([
            'criteria' => [
                'type' => 'physical',
                'name' => 'home',
            ],
        ]);
    }

    protected function assertReferenceOneWasBuiltCorrectly(array $expectedFields, array $deleteFields = [])
    {
        $this->builder->build($this->metadata);

        $this->assertFieldMappingIsCorrect(
            $this->getReferenceOneDefaultMapping(),
            $expectedFields,
            $this->metadata->fieldMappings['address'],
            $deleteFields
        );
    }

    protected function getReferenceOneDefaultMapping(): array
    {
        return [
            'name' => 'address',
            'fieldName' => 'address',
            'targetDocument' => AnotherEntityStub::class,
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
    }
}
