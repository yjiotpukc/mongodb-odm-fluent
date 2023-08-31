<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Examples\Mapping\Entity\Inheritance;

use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;

/**
 * @Document
 */
class Cat extends Mammal
{
    /** @Field(type="string") */
    private string $catPrivate;
    /** @Field(type="string") */
    protected string $catProtected;
    /** @Field(type="string") */
    public string $catPublic;

    public static function loadMetadata(ClassMetadata $classMetadata): void
    {
        $builder = new DocumentBuilder();
        $builder->string('catPrivate');
        $builder->string('catProtected');
        $builder->string('catPublic');
        $builder->build($classMetadata);
    }
}
