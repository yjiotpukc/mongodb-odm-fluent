<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field;

use yjiotpukc\MongoODMFluent\Builder\Field\ReferenceOne;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\AnotherEntityStub;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\BuilderBaseTestCase;
use yjiotpukc\MongoODMFluent\Type\Cascade;
use yjiotpukc\MongoODMFluent\Type\Discriminator;

class ReferenceOneTest extends BuilderBaseTestCase
{
    public function testReferenceOne()
    {
        $this->givenDefaultBuilder();

        $this->assertReferenceOneWasBuiltCorrectly([]);
    }

    public function testReferenceOneWithTarget()
    {
        $this->givenBuilder('address')->target(AnotherEntityStub::class);

        $this->assertReferenceOneWasBuiltCorrectly([]);
    }

    public function testReferenceOneWithoutTarget()
    {
        $this->givenBuilder('address');

        $this->assertReferenceOneWasBuiltCorrectly(
            ['discriminatorField' => '_doctrine_class_name'],
            ['targetDocument']
        );
    }

    public function testReferenceOneAsDbRef()
    {
        $this->givenDefaultBuilder()->storeAsDbRef();

        $this->assertReferenceOneWasBuiltCorrectly([]);
    }

    public function testReferenceOneAsDbRefWithDb()
    {
        $this->givenDefaultBuilder()->storeAsDbRefWithDb();

        $this->assertReferenceOneWasBuiltCorrectly(['storeAs' => 'dbRefWithDb']);
    }

    public function testReferenceOneAsRef()
    {
        $this->givenDefaultBuilder()->storeAsRef();

        $this->assertReferenceOneWasBuiltCorrectly(['storeAs' => 'ref']);
    }

    public function testReferenceOneAsId()
    {
        $this->givenDefaultBuilder()->storeAsId();

        $this->assertReferenceOneWasBuiltCorrectly(['storeAs' => 'id']);
    }

    public function testNullableReferenceOne()
    {
        $this->givenDefaultBuilder()->nullable();

        $this->assertReferenceOneWasBuiltCorrectly(['nullable' => true]);
    }

    public function testNotSavedReferenceOne()
    {
        $this->givenDefaultBuilder()->notSaved();

        $this->assertReferenceOneWasBuiltCorrectly(['notSaved' => true]);
    }

    public function testReferenceOneWithOrphanRemoval()
    {
        $this->givenDefaultBuilder()->orphanRemoval();

        $this->assertReferenceOneWasBuiltCorrectly(['orphanRemoval' => true]);
    }

    /**
     * @dataProvider cascadeProvider
     */
    public function testReferenceOneWithCascadeAll(Cascade $cascade, array $expectedFields)
    {
        $this->givenDefaultBuilder()->cascade($cascade);

        $this->assertReferenceOneWasBuiltCorrectly($expectedFields);
    }

    public function testReferenceOneWithRepositoryMethod()
    {
        $this->givenDefaultBuilder()->repositoryMethod('getAddresses');

        $this->assertReferenceOneWasBuiltCorrectly([
            'isInverseSide' => true,
            'isOwningSide' => false,
            'repositoryMethod' => 'getAddresses',
        ]);
    }

    public function testReferenceOneWithSkip()
    {
        $this->givenDefaultBuilder()->skip(4);

        $this->assertReferenceOneWasBuiltCorrectly(['skip' => 4]);
    }

    public function testReferenceOneWithMappedBy()
    {
        $this->givenDefaultBuilder()->mappedBy('user_id');

        $this->assertReferenceOneWasBuiltCorrectly([
            'isInverseSide' => true,
            'isOwningSide' => false,
            'mappedBy' => 'user_id',
        ]);
    }

    public function testReferenceOneWithInversedBy()
    {
        $this->givenDefaultBuilder()->inversedBy('address_id');

        $this->assertReferenceOneWasBuiltCorrectly(['inversedBy' => 'address_id']);
    }

    /**
     * @dataProvider discriminatorProvider
     */
    public function testReferenceOneWithDiscriminator(Discriminator $discriminator, array $expectedFields)
    {
        $this->givenDefaultBuilder()->discriminator($discriminator);

        $this->assertReferenceOneWasBuiltCorrectly($expectedFields);
    }

    public function testReferenceOneWithSortDefault()
    {
        $this->givenDefaultBuilder()->addSort('sort');

        $this->assertReferenceOneWasBuiltCorrectly(['sort' => ['sort' => 'asc']]);
    }

    public function testReferenceOneWithSortAsc()
    {
        $this->givenDefaultBuilder()->addSort('sort', 'asc');

        $this->assertReferenceOneWasBuiltCorrectly(['sort' => ['sort' => 'asc']]);
    }

    public function testReferenceOneWithSortDesc()
    {
        $this->givenDefaultBuilder()->addSort('sort', 'desc');

        $this->assertReferenceOneWasBuiltCorrectly(['sort' => ['sort' => 'desc']]);
    }

    public function testReferenceOneWithMultiSort()
    {
        $this->givenDefaultBuilder()->addSort('sort', 'desc')->addSort('id');

        $this->assertReferenceOneWasBuiltCorrectly([
            'sort' => [
                'sort' => 'desc',
                'id' => 'asc',
            ],
        ]);
    }

    public function testReferenceOneWithCriteria()
    {
        $this->givenDefaultBuilder()->addCriteria('type', 'physical');

        $this->assertReferenceOneWasBuiltCorrectly(['criteria' => ['type' => 'physical']]);
    }

    public function testReferenceOneWithMultiCriteria()
    {
        $this->givenDefaultBuilder()->addCriteria('type', 'physical')->addCriteria('name', 'home');

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

    protected function givenDefaultBuilder(): ReferenceOne
    {
        return $this->givenBuilder('address', AnotherEntityStub::class);
    }

    protected function givenBuilder(string $fieldName, string $target = ''): ReferenceOne
    {
        $this->builder = new ReferenceOne($fieldName, $target);

        return $this->builder;
    }
}
