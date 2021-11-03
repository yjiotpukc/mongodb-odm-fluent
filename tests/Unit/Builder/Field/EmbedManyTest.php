<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field;

use yjiotpukc\MongoODMFluent\Builder\Field\EmbedMany;
use yjiotpukc\MongoODMFluent\Tests\Stubs\CollectionStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\AnotherEntityStub;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Traits\CollectionStrategyProvider;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Traits\DiscriminatorProvider;
use yjiotpukc\MongoODMFluent\Type\CollectionStrategy;
use yjiotpukc\MongoODMFluent\Type\Discriminator;

class EmbedManyTest extends FieldTestCase
{
    use CollectionStrategyProvider;
    use DiscriminatorProvider;

    public function testEmbedMany()
    {
        $this->givenDefaultBuilder();

        $this->assertFieldBuildsCorrectly();
    }

    public function testEmbedManyWithTarget()
    {
        $this->givenBuilder('address')->target(AnotherEntityStub::class);

        $this->assertFieldBuildsCorrectly();
    }

    public function testEmbedManyWithoutTarget()
    {
        $this->givenBuilder('address');

        $this->assertFieldBuildsCorrectly(
            ['discriminatorField' => '_doctrine_class_name'],
            'address',
            ['targetDocument']
        );
    }

    public function testNotSavedEmbedMany()
    {
        $this->givenDefaultBuilder()->notSaved();

        $this->assertFieldBuildsCorrectly(['notSaved' => true]);
    }

    /**
     * @dataProvider discriminatorProvider
     */
    public function testEmbedManyWithDiscriminator(Discriminator $discriminator, array $expectedFields)
    {
        $this->givenDefaultBuilder()->discriminator($discriminator);

        $this->assertFieldBuildsCorrectly($expectedFields);
    }

    public function testEmbedManyWithCollectionClass()
    {
        $this->givenDefaultBuilder()->collectionClass(CollectionStub::class);

        $this->assertFieldBuildsCorrectly(['collectionClass' => CollectionStub::class]);
    }

    /**
     * @dataProvider collectionStrategyProvider
     */
    public function testEmbedManyWithCollectionStrategy(CollectionStrategy $strategy, array $expectedFields)
    {
        $this->givenDefaultBuilder()->strategy($strategy);

        $this->assertFieldBuildsCorrectly($expectedFields);
    }

    protected function getDefaultMapping(): array
    {
        return [
            'association' => 4,
            'embedded' => true,
            'fieldName' => 'address',
            'targetDocument' => AnotherEntityStub::class,
            'isCascadeDetach' => true,
            'isCascadeMerge' => true,
            'isCascadePersist' => true,
            'isCascadeRefresh' => true,
            'isCascadeRemove' => true,
            'isInverseSide' => false,
            'isOwningSide' => true,
            'name' => 'address',
            'nullable' => false,
            'notSaved' => false,
            'strategy' => 'pushAll',
            'type' => 'many',
        ];
    }

    protected function getDefaultFieldName(): string
    {
        return 'address';
    }

    protected function givenDefaultBuilder(): EmbedMany
    {
        return $this->givenBuilder('address', AnotherEntityStub::class);
    }

    protected function givenBuilder(string $fieldName, string $target = ''): EmbedMany
    {
        $this->builder = new EmbedMany($fieldName, $target);

        return $this->builder;
    }
}
