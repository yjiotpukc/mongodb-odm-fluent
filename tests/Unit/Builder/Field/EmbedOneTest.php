<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Field;

use yjiotpukc\MongoODMFluent\Builder\Field\EmbedOne;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\AnotherEntityStub;
use yjiotpukc\MongoODMFluent\Tests\Unit\Builder\Traits\DiscriminatorProvider;
use yjiotpukc\MongoODMFluent\Type\Discriminator;

class EmbedOneTest extends FieldTestCase
{
    use DiscriminatorProvider;

    public function testEmbedOne()
    {
        $this->givenDefaultBuilder();

        $this->assertFieldBuildsCorrectly();
    }

    public function testEmbedOneWithTarget()
    {
        $this->givenBuilder('address')->target(AnotherEntityStub::class);

        $this->assertFieldBuildsCorrectly();
    }

    public function testEmbedOneWithoutTarget()
    {
        $this->givenBuilder('address');

        $this->assertFieldBuildsCorrectly(
            ['discriminatorField' => '_doctrine_class_name'],
            'address',
            ['targetDocument']
        );
    }

    public function testNotSavedEmbedOne()
    {
        $this->givenDefaultBuilder()->notSaved();

        $this->assertFieldBuildsCorrectly(['notSaved' => true]);
    }

    /**
     * @dataProvider discriminatorProvider
     */
    public function testEmbedOneWithDiscriminator(Discriminator $discriminator, array $expectedFields)
    {
        $this->givenDefaultBuilder()->discriminator($discriminator);

        $this->assertFieldBuildsCorrectly($expectedFields);
    }

    public static function getDefaultMapping(): array
    {
        return [
            'association' => 3,
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
            'strategy' => 'set',
            'type' => 'one',
        ];
    }

    public static function getDefaultFieldName(): string
    {
        return 'address';
    }

    protected function givenDefaultBuilder(): EmbedOne
    {
        return $this->givenBuilder('address', AnotherEntityStub::class);
    }

    protected function givenBuilder(string $fieldName, string $target = ''): EmbedOne
    {
        $this->builder = new EmbedOne($fieldName, $target);

        return $this->builder;
    }
}
