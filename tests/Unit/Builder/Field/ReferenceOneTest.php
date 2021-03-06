<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field;

use yjiotpukc\MongoODMFluent\Builder\Field\ReferenceOneBuilder;
use yjiotpukc\MongoODMFluent\Tests\Stubs\AnotherEntityStub;

class ReferenceOneTest extends FieldTestCase
{
    public static function getDefaultMapping(): array
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

    public static function getDefaultFieldName(): string
    {
        return 'address';
    }

    public function testReferenceOne(): void
    {
        $this->givenDefaultBuilder();

        $this->assertFieldBuildsCorrectly();
    }

    protected function givenDefaultBuilder(): ReferenceOneBuilder
    {
        return $this->givenBuilder('address', AnotherEntityStub::class);
    }

    protected function givenBuilder(string $fieldName, string $target = ''): ReferenceOneBuilder
    {
        $this->builder = new ReferenceOneBuilder($fieldName, $target);

        return $this->builder;
    }

    public function testReferenceOneWithTarget(): void
    {
        $this->givenBuilder('address')->target(AnotherEntityStub::class);

        $this->assertFieldBuildsCorrectly();
    }

    public function testReferenceOneWithoutTarget(): void
    {
        $this->givenBuilder('address');

        $this->assertFieldBuildsCorrectly(
            ['discriminatorField' => '_doctrine_class_name'],
            'address',
            ['targetDocument']
        );
    }

    public function testReferenceOneAsDbRef(): void
    {
        $this->givenDefaultBuilder()->storeAsDbRef();

        $this->assertFieldBuildsCorrectly();
    }

    public function testReferenceOneAsDbRefWithDb(): void
    {
        $this->givenDefaultBuilder()->storeAsDbRefWithDb();

        $this->assertFieldBuildsCorrectly(['storeAs' => 'dbRefWithDb']);
    }

    public function testReferenceOneAsRef(): void
    {
        $this->givenDefaultBuilder()->storeAsRef();

        $this->assertFieldBuildsCorrectly(['storeAs' => 'ref']);
    }

    public function testReferenceOneAsId(): void
    {
        $this->givenDefaultBuilder()->storeAsId();

        $this->assertFieldBuildsCorrectly(['storeAs' => 'id']);
    }

    public function testNullableReferenceOne(): void
    {
        $this->givenDefaultBuilder()->nullable();

        $this->assertFieldBuildsCorrectly(['nullable' => true]);
    }

    public function testNotSavedReferenceOne(): void
    {
        $this->givenDefaultBuilder()->notSaved();

        $this->assertFieldBuildsCorrectly(['notSaved' => true]);
    }

    public function testReferenceOneWithOrphanRemoval(): void
    {
        $this->givenDefaultBuilder()->orphanRemoval();

        $this->assertFieldBuildsCorrectly(['orphanRemoval' => true]);
    }

    public function testReferenceOneWithCascadeAll(): void
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

    public function testReferenceOneWithRepositoryMethod(): void
    {
        $this->givenDefaultBuilder()->repositoryMethod('getAddresses');

        $this->assertFieldBuildsCorrectly([
            'isInverseSide' => true,
            'isOwningSide' => false,
            'repositoryMethod' => 'getAddresses',
        ]);
    }

    public function testReferenceOneWithSkip(): void
    {
        $this->givenDefaultBuilder()->skip(4);

        $this->assertFieldBuildsCorrectly(['skip' => 4]);
    }

    public function testReferenceOneWithMappedBy(): void
    {
        $this->givenDefaultBuilder()->mappedBy('user_id');

        $this->assertFieldBuildsCorrectly([
            'isInverseSide' => true,
            'isOwningSide' => false,
            'mappedBy' => 'user_id',
        ]);
    }

    public function testReferenceOneWithInversedBy(): void
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

    public function testReferenceOneWithSortDefault(): void
    {
        $this->givenDefaultBuilder()->addSort('sort');

        $this->assertFieldBuildsCorrectly(['sort' => ['sort' => 'asc']]);
    }

    public function testReferenceOneWithSortAsc(): void
    {
        $this->givenDefaultBuilder()->addSort('sort', 'asc');

        $this->assertFieldBuildsCorrectly(['sort' => ['sort' => 'asc']]);
    }

    public function testReferenceOneWithSortDesc(): void
    {
        $this->givenDefaultBuilder()->addSort('sort', 'desc');

        $this->assertFieldBuildsCorrectly(['sort' => ['sort' => 'desc']]);
    }

    public function testReferenceOneWithMultiSort(): void
    {
        $this->givenDefaultBuilder()->addSort('sort', 'desc')->addSort('id');

        $this->assertFieldBuildsCorrectly([
            'sort' => [
                'sort' => 'desc',
                'id' => 'asc',
            ],
        ]);
    }

    public function testReferenceOneWithCriteria(): void
    {
        $this->givenDefaultBuilder()->addCriteria('type', 'physical');

        $this->assertFieldBuildsCorrectly(['criteria' => ['type' => 'physical']]);
    }

    public function testReferenceOneWithMultiCriteria(): void
    {
        $this->givenDefaultBuilder()->addCriteria('type', 'physical')->addCriteria('name', 'home');

        $this->assertFieldBuildsCorrectly([
            'criteria' => [
                'type' => 'physical',
                'name' => 'home',
            ],
        ]);
    }
}
