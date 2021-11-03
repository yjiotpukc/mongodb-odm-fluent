<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field;

use yjiotpukc\MongoODMFluent\Builder\Field\ReferenceMany;
use yjiotpukc\MongoODMFluent\Tests\Stubs\CollectionStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\AnotherEntityStub;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\BuilderTestCase;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Traits\CascadeProvider;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Traits\CollectionStrategyProvider;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Traits\DiscriminatorProvider;
use yjiotpukc\MongoODMFluent\Type\Cascade;
use yjiotpukc\MongoODMFluent\Type\CollectionStrategy;
use yjiotpukc\MongoODMFluent\Type\Discriminator;

class ReferenceManyTest extends BuilderTestCase
{
    use CascadeProvider;
    use CollectionStrategyProvider;
    use DiscriminatorProvider;

    public function testReferenceMany()
    {
        $this->givenDefaultBuilder();

        $this->assertReferenceManyWasBuiltCorrectly([]);
    }

    public function testReferenceManyWithTarget()
    {
        $this->givenBuilder('address')->target(AnotherEntityStub::class);

        $this->assertReferenceManyWasBuiltCorrectly([]);
    }

    public function testReferenceManyWithoutTarget()
    {
        $this->givenBuilder('address');

        $this->assertReferenceManyWasBuiltCorrectly(
            ['discriminatorField' => '_doctrine_class_name'],
            ['targetDocument']
        );
    }

    public function testReferenceManyAsDbRef()
    {
        $this->givenDefaultBuilder()->storeAsDbRef();

        $this->assertReferenceManyWasBuiltCorrectly([]);
    }

    public function testReferenceManyAsDbRefWithDb()
    {
        $this->givenDefaultBuilder()->storeAsDbRefWithDb();

        $this->assertReferenceManyWasBuiltCorrectly(['storeAs' => 'dbRefWithDb']);
    }

    public function testReferenceManyAsRef()
    {
        $this->givenDefaultBuilder()->storeAsRef();

        $this->assertReferenceManyWasBuiltCorrectly(['storeAs' => 'ref']);
    }

    public function testReferenceManyAsId()
    {
        $this->givenDefaultBuilder()->storeAsId();

        $this->assertReferenceManyWasBuiltCorrectly(['storeAs' => 'id']);
    }

    public function testNullableReferenceMany()
    {
        $this->givenDefaultBuilder()->nullable();

        $this->assertReferenceManyWasBuiltCorrectly(['nullable' => true]);
    }

    public function testNotSavedReferenceMany()
    {
        $this->givenDefaultBuilder()->notSaved();

        $this->assertReferenceManyWasBuiltCorrectly(['notSaved' => true]);
    }

    public function testReferenceManyWithOrphanRemoval()
    {
        $this->givenDefaultBuilder()->orphanRemoval();

        $this->assertReferenceManyWasBuiltCorrectly(['orphanRemoval' => true]);
    }

    /**
     * @dataProvider cascadeProvider
     */
    public function testReferenceManyWithCascadeAll(Cascade $cascade, array $expectedFields)
    {
        $this->givenDefaultBuilder()->cascade($cascade);

        $this->assertReferenceManyWasBuiltCorrectly($expectedFields);
    }

    public function testReferenceManyWithRepositoryMethod()
    {
        $this->givenDefaultBuilder()->repositoryMethod('getAddresses');

        $this->assertReferenceManyWasBuiltCorrectly([
            'isInverseSide' => true,
            'isOwningSide' => false,
            'repositoryMethod' => 'getAddresses',
        ]);
    }

    public function testReferenceManyWithSkip()
    {
        $this->givenDefaultBuilder()->skip(4);

        $this->assertReferenceManyWasBuiltCorrectly(['skip' => 4]);
    }

    public function testReferenceManyWithLimit()
    {
        $this->givenDefaultBuilder()->limit(5);

        $this->assertReferenceManyWasBuiltCorrectly(['limit' => 5]);
    }

    public function testReferenceManyWithMappedBy()
    {
        $this->givenDefaultBuilder()->mappedBy('user_id');

        $this->assertReferenceManyWasBuiltCorrectly([
            'isInverseSide' => true,
            'isOwningSide' => false,
            'mappedBy' => 'user_id',
        ]);
    }

    public function testReferenceManyWithInversedBy()
    {
        $this->givenDefaultBuilder()->inversedBy('address_id');

        $this->assertReferenceManyWasBuiltCorrectly(['inversedBy' => 'address_id']);
    }

    /**
     * @dataProvider discriminatorProvider
     */
    public function testReferenceManyWithDiscriminator(Discriminator $discriminator, array $expectedFields)
    {
        $this->givenDefaultBuilder()->discriminator($discriminator);

        $this->assertReferenceManyWasBuiltCorrectly($expectedFields);
    }

    public function testReferenceManyWithSortDefault()
    {
        $this->givenDefaultBuilder()
            ->strategy((new CollectionStrategy())->setArray())
            ->addSort('sort');

        $this->assertReferenceManyWasBuiltCorrectly([
            'strategy' => 'setArray',
            'sort' => ['sort' => 'asc'],
        ]);
    }

    public function testReferenceManyWithSortAsc()
    {
        $this->givenDefaultBuilder()
            ->strategy((new CollectionStrategy())->setArray())
            ->addSort('sort', 'asc');

        $this->assertReferenceManyWasBuiltCorrectly([
            'strategy' => 'setArray',
            'sort' => ['sort' => 'asc'],
        ]);
    }

    public function testReferenceManyWithSortDesc()
    {
        $this->givenDefaultBuilder()
            ->strategy((new CollectionStrategy())->setArray())
            ->addSort('sort', 'desc');

        $this->assertReferenceManyWasBuiltCorrectly([
            'strategy' => 'setArray',
            'sort' => ['sort' => 'desc'],
        ]);
    }

    public function testReferenceManyWithMultiSort()
    {
        $this->givenDefaultBuilder()
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
        $this->givenDefaultBuilder()->addCriteria('type', 'physical');

        $this->assertReferenceManyWasBuiltCorrectly(['criteria' => ['type' => 'physical']]);
    }

    public function testReferenceManyWithMultiCriteria()
    {
        $this->givenDefaultBuilder()
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
        $this->givenDefaultBuilder()->strategy($strategy);

        $this->assertReferenceManyWasBuiltCorrectly($expectedFields);
    }

    public function testReferenceManyWithCollectionClass()
    {
        $this->givenDefaultBuilder()->collectionClass(CollectionStub::class);

        $this->assertReferenceManyWasBuiltCorrectly(['collectionClass' => CollectionStub::class]);
    }

    public function testReferenceManyWithPrime()
    {
        $this->givenDefaultBuilder()->mappedBy('user_id')->addPrime('type');

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

    protected function givenDefaultBuilder(): ReferenceMany
    {
        return $this->givenBuilder('address', AnotherEntityStub::class);
    }

    protected function givenBuilder(string $fieldName, string $target = ''): ReferenceMany
    {
        $this->builder = new ReferenceMany($fieldName, $target);

        return $this->builder;
    }
}
