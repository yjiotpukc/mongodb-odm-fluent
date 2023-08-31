<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Examples\Mapping\Entity\Inheritance;

use Doctrine\ODM\MongoDB\Mapping\Annotations\DiscriminatorField;
use Doctrine\ODM\MongoDB\Mapping\Annotations\DiscriminatorMap;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;
use Doctrine\ODM\MongoDB\Mapping\Annotations\MappedSuperclass;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;

/**
 * @MappedSuperclass
 * @DiscriminatorField("type")
 * @DiscriminatorMap({"akita"=Akita::class, "pomeranian"=Pomeranian::class})
 */
class PedigreeDog extends Dog
{
    /** @Field(type="string") */
    private string $pedigreeDogPrivate;
    /** @Field(type="string") */
    protected string $pedigreeDogProtected;
    /** @Field(type="string") */
    public string $pedigreeDogPublic;

    public static function loadMetadata(ClassMetadata $classMetadata): void
    {
        $builder = new DocumentBuilder();
        $builder->mappedSuperclass();
        $builder
            ->discriminator('type')
            ->map('akita', Akita::class)
            ->map('pomeranian', Pomeranian::class);
        $builder->string('pedigreeDogPrivate');
        $builder->string('pedigreeDogProtected');
        $builder->string('pedigreeDogPublic');
        $builder->build($classMetadata);
    }
}