<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Examples\Mapping\Entity\Inheritance;

use Doctrine\ODM\MongoDB\Mapping\Annotations\DiscriminatorField;
use Doctrine\ODM\MongoDB\Mapping\Annotations\DiscriminatorMap;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;
use Doctrine\ODM\MongoDB\Mapping\Annotations\InheritanceType;
use Doctrine\ODM\MongoDB\Mapping\Annotations\MappedSuperclass;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;

/**
 * @MappedSuperclass
 * @DiscriminatorField("type")
 * @DiscriminatorMap({"cat"=Cat::class, "dog"=Dog::class})
 * @InheritanceType("COLLECTION_PER_CLASS")
 */
class Mammal extends Animal
{
    /** @Field(type="string") */
    private string $mammalPrivate;
    /** @Field(type="string") */
    protected string $mammalProtected;
    /** @Field(type="string") */
    public string $mammalPublic;

    public static function loadMetadata(ClassMetadata $classMetadata): void
    {
        $builder = new DocumentBuilder();
        $builder->mappedSuperclass();
        $builder
            ->discriminator('type')
            ->map('cat', Cat::class)
            ->map('dog', Dog::class);
        $builder->collectionPerClass();
        $builder->string('mammalPrivate');
        $builder->string('mammalProtected');
        $builder->string('mammalPublic');
        $builder->build($classMetadata);
    }
}
