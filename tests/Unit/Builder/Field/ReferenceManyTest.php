<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field;

use yjiotpukc\MongoODMFluent\Builder\Field\ReferenceManyBuilder;
use yjiotpukc\MongoODMFluent\Tests\Stubs\AnotherEntityStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\CollectionStub;

class ReferenceManyTest extends FieldTestCase
{
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

    public function testReferenceMany(): void
    {
        $this->givenDefaultBuilder();

        $this->assertFieldBuildsCorrectly();
    }

    protected function givenDefaultBuilder(): ReferenceManyBuilder
    {
        return $this->givenBuilder('address', AnotherEntityStub::class);
    }

    protected function givenBuilder(string $fieldName, string $target = ''): ReferenceManyBuilder
    {
        $this->builder = new ReferenceManyBuilder($fieldName, $target);

        return $this->builder;
    }

    public function testReferenceManyWithTarget(): void
    {
        $this->givenBuilder('address')->target(AnotherEntityStub::class);

        $this->assertFieldBuildsCorrectly();
    }

    public function testReferenceManyWithoutTarget(): void
    {
        $this->givenBuilder('address');

        $this->assertFieldBuildsCorrectly(
            ['discriminatorField' => '_doctrine_class_name'],
            'address',
            ['targetDocument']
        );
    }

    public function testReferenceManyAsDbRef(): void
    {
        $this->givenDefaultBuilder()->storeAsDbRef();

        $this->assertFieldBuildsCorrectly();
    }

    public function testReferenceManyAsDbRefWithDb(): void
    {
        $this->givenDefaultBuilder()->storeAsDbRefWithDb();

        $this->assertFieldBuildsCorrectly(['storeAs' => 'dbRefWithDb']);
    }

    public function testReferenceManyAsRef(): void
    {
        $this->givenDefaultBuilder()->storeAsRef();

        $this->assertFieldBuildsCorrectly(['storeAs' => 'ref']);
    }

    public function testReferenceManyAsId(): void
    {
        $this->givenDefaultBuilder()->storeAsId();

        $this->assertFieldBuildsCorrectly(['storeAs' => 'id']);
    }

    public function testNullableReferenceMany(): void
    {
        $this->givenDefaultBuilder()->nullable();

        $this->assertFieldBuildsCorrectly(['nullable' => true]);
    }

    public function testNotSavedReferenceMany(): void
    {
        $this->givenDefaultBuilder()->notSaved();

        $this->assertFieldBuildsCorrectly(['notSaved' => true]);
    }

    public function testReferenceManyWithOrphanRemoval(): void
    {
        $this->givenDefaultBuilder()->orphanRemoval();

        $this->assertFieldBuildsCorrectly(['orphanRemoval' => true]);
    }

    public function testReferenceManyWithCascadeAll(): void
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

    public function testReferenceManyWithRepositoryMethod(): void
    {
        $this->givenDefaultBuilder()->repositoryMethod('getAddresses');

        $this->assertFieldBuildsCorrectly([
            'isInverseSide' => true,
            'isOwningSide' => false,
            'repositoryMethod' => 'getAddresses',
        ]);
    }

    public function testReferenceManyWithSkip(): void
    {
        $this->givenDefaultBuilder()->skip(4);

        $this->assertFieldBuildsCorrectly(['skip' => 4]);
    }

    public function testReferenceManyWithLimit(): void
    {
        $this->givenDefaultBuilder()->limit(5);

        $this->assertFieldBuildsCorrectly(['limit' => 5]);
    }

    public function testReferenceManyWithMappedBy(): void
    {
        $this->givenDefaultBuilder()->mappedBy('user_id');

        $this->assertFieldBuildsCorrectly([
            'isInverseSide' => true,
            'isOwningSide' => false,
            'mappedBy' => 'user_id',
        ]);
    }

    public function testReferenceManyWithInversedBy(): void
    {
        $this->givenDefaultBuilder()->inversedBy('address_id');

        $this->assertFieldBuildsCorrectly(['inversedBy' => 'address_id']);
    }

    public function testReferenceOneWithDiscriminator(): void
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

    public function testReferenceManyWithSortDefault(): void
    {
        $this->givenBuilderWithSetArrayStrategy()->addSort('sort');

        $this->assertFieldBuildsCorrectly([
            'strategy' => 'setArray',
            'sort' => ['sort' => 'asc'],
        ]);
    }

    protected function givenBuilderWithSetArrayStrategy(): ReferenceManyBuilder
    {
        $builder = $this->givenDefaultBuilder();
        $builder->strategy()->setArray();

        return $builder;
    }

    public function testReferenceManyWithSortAsc(): void
    {
        $this->givenBuilderWithSetArrayStrategy()->addSort('sort', 'asc');

        $this->assertFieldBuildsCorrectly([
            'strategy' => 'setArray',
            'sort' => ['sort' => 'asc'],
        ]);
    }

    public function testReferenceManyWithSortDesc(): void
    {
        $this->givenBuilderWithSetArrayStrategy()->addSort('sort', 'desc');

        $this->assertFieldBuildsCorrectly([
            'strategy' => 'setArray',
            'sort' => ['sort' => 'desc'],
        ]);
    }

    public function testReferenceManyWithMultiSort(): void
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

    public function testReferenceManyWithCriteria(): void
    {
        $this->givenDefaultBuilder()->addCriteria('type', 'physical');

        $this->assertFieldBuildsCorrectly(['criteria' => ['type' => 'physical']]);
    }

    public function testReferenceManyWithMultiCriteria(): void
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

    public function testReferenceManyWithCollectionStrategy(): void
    {
        $this->givenDefaultBuilder()->strategy()->setArray();

        $this->assertFieldBuildsCorrectly(['strategy' => 'setArray']);
    }

    public function testReferenceManyWithCollectionClass(): void
    {
        $this->givenDefaultBuilder()->collectionClass(CollectionStub::class);

        $this->assertFieldBuildsCorrectly(['collectionClass' => CollectionStub::class]);
    }

    public function testReferenceManyWithPrime(): void
    {
        $this->givenDefaultBuilder()->mappedBy('user_id')->addPrime('type');

        $this->assertFieldBuildsCorrectly([
            'isInverseSide' => true,
            'isOwningSide' => false,
            'mappedBy' => 'user_id',
            'prime' => ['type'],
        ]);
    }
}
