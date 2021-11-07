<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field;

use yjiotpukc\MongoODMFluent\Builder\Field\ReferenceManyBuilder;
use yjiotpukc\MongoODMFluent\Tests\Stubs\CollectionStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\AnotherEntityStub;

class ReferenceManyTest extends FieldTestCase
{
    public function testReferenceMany()
    {
        $this->givenDefaultBuilder();

        $this->assertFieldBuildsCorrectly();
    }

    public function testReferenceManyWithTarget()
    {
        $this->givenBuilder('address')->target(AnotherEntityStub::class);

        $this->assertFieldBuildsCorrectly();
    }

    public function testReferenceManyWithoutTarget()
    {
        $this->givenBuilder('address');

        $this->assertFieldBuildsCorrectly(
            ['discriminatorField' => '_doctrine_class_name'],
            'address',
            ['targetDocument']
        );
    }

    public function testReferenceManyAsDbRef()
    {
        $this->givenDefaultBuilder()->storeAsDbRef();

        $this->assertFieldBuildsCorrectly();
    }

    public function testReferenceManyAsDbRefWithDb()
    {
        $this->givenDefaultBuilder()->storeAsDbRefWithDb();

        $this->assertFieldBuildsCorrectly(['storeAs' => 'dbRefWithDb']);
    }

    public function testReferenceManyAsRef()
    {
        $this->givenDefaultBuilder()->storeAsRef();

        $this->assertFieldBuildsCorrectly(['storeAs' => 'ref']);
    }

    public function testReferenceManyAsId()
    {
        $this->givenDefaultBuilder()->storeAsId();

        $this->assertFieldBuildsCorrectly(['storeAs' => 'id']);
    }

    public function testNullableReferenceMany()
    {
        $this->givenDefaultBuilder()->nullable();

        $this->assertFieldBuildsCorrectly(['nullable' => true]);
    }

    public function testNotSavedReferenceMany()
    {
        $this->givenDefaultBuilder()->notSaved();

        $this->assertFieldBuildsCorrectly(['notSaved' => true]);
    }

    public function testReferenceManyWithOrphanRemoval()
    {
        $this->givenDefaultBuilder()->orphanRemoval();

        $this->assertFieldBuildsCorrectly(['orphanRemoval' => true]);
    }

    public function testReferenceManyWithCascadeAll()
    {
        $this->givenDefaultBuilder()->cascade()->all();

        $this->assertFieldBuildsCorrectly([
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
        ]);
    }

    public function testReferenceManyWithRepositoryMethod()
    {
        $this->givenDefaultBuilder()->repositoryMethod('getAddresses');

        $this->assertFieldBuildsCorrectly([
            'isInverseSide' => true,
            'isOwningSide' => false,
            'repositoryMethod' => 'getAddresses',
        ]);
    }

    public function testReferenceManyWithSkip()
    {
        $this->givenDefaultBuilder()->skip(4);

        $this->assertFieldBuildsCorrectly(['skip' => 4]);
    }

    public function testReferenceManyWithLimit()
    {
        $this->givenDefaultBuilder()->limit(5);

        $this->assertFieldBuildsCorrectly(['limit' => 5]);
    }

    public function testReferenceManyWithMappedBy()
    {
        $this->givenDefaultBuilder()->mappedBy('user_id');

        $this->assertFieldBuildsCorrectly([
            'isInverseSide' => true,
            'isOwningSide' => false,
            'mappedBy' => 'user_id',
        ]);
    }

    public function testReferenceManyWithInversedBy()
    {
        $this->givenDefaultBuilder()->inversedBy('address_id');

        $this->assertFieldBuildsCorrectly(['inversedBy' => 'address_id']);
    }

    public function testReferenceOneWithDiscriminator()
    {
        $this->givenDefaultBuilder()
            ->discriminator('type')
            ->default('physical')
            ->map('physical', AnotherEntityStub::class);

        $this->assertFieldBuildsCorrectly([
            'discriminatorField' => 'type',
            'defaultDiscriminatorValue' => 'physical',
            'discriminatorMap' => ['physical' => AnotherEntityStub::class],
        ]);
    }

    public function testReferenceManyWithSortDefault()
    {
        $this->givenBuilderWithSetArrayStrategy()->addSort('sort');

        $this->assertFieldBuildsCorrectly([
            'strategy' => 'setArray',
            'sort' => ['sort' => 'asc'],
        ]);
    }

    public function testReferenceManyWithSortAsc()
    {
        $this->givenBuilderWithSetArrayStrategy()->addSort('sort', 'asc');

        $this->assertFieldBuildsCorrectly([
            'strategy' => 'setArray',
            'sort' => ['sort' => 'asc'],
        ]);
    }

    public function testReferenceManyWithSortDesc()
    {
        $this->givenBuilderWithSetArrayStrategy()->addSort('sort', 'desc');

        $this->assertFieldBuildsCorrectly([
            'strategy' => 'setArray',
            'sort' => ['sort' => 'desc'],
        ]);
    }

    public function testReferenceManyWithMultiSort()
    {
        $this->givenBuilderWithSetArrayStrategy()->addSort('sort', 'desc')->addSort('id');

        $this->assertFieldBuildsCorrectly([
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

        $this->assertFieldBuildsCorrectly(['criteria' => ['type' => 'physical']]);
    }

    public function testReferenceManyWithMultiCriteria()
    {
        $this->givenDefaultBuilder()
            ->addCriteria('type', 'physical')
            ->addCriteria('name', 'home');

        $this->assertFieldBuildsCorrectly([
            'criteria' => [
                'type' => 'physical',
                'name' => 'home',
            ],
        ]);
    }

    public function testReferenceManyWithCollectionStrategy()
    {
        $this->givenDefaultBuilder()->strategy()->setArray();

        $this->assertFieldBuildsCorrectly(['strategy' => 'setArray']);
    }

    public function testReferenceManyWithCollectionClass()
    {
        $this->givenDefaultBuilder()->collectionClass(CollectionStub::class);

        $this->assertFieldBuildsCorrectly(['collectionClass' => CollectionStub::class]);
    }

    public function testReferenceManyWithPrime()
    {
        $this->givenDefaultBuilder()->mappedBy('user_id')->addPrime('type');

        $this->assertFieldBuildsCorrectly([
            'isInverseSide' => true,
            'isOwningSide' => false,
            'mappedBy' => 'user_id',
            'prime' => ['type'],
        ]);
    }

    protected function givenDefaultBuilder(): ReferenceManyBuilder
    {
        return $this->givenBuilder('address', AnotherEntityStub::class);
    }

    protected function givenBuilderWithSetArrayStrategy(): ReferenceManyBuilder
    {
        $builder = $this->givenDefaultBuilder();
        $builder->strategy()->setArray();

        return $builder;
    }

    protected function givenBuilder(string $fieldName, string $target = ''): ReferenceManyBuilder
    {
        $this->builder = new ReferenceManyBuilder($fieldName, $target);

        return $this->builder;
    }

    public static function getDefaultFieldName(): string
    {
        return 'address';
    }

    public static function getDefaultMapping(): array
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
