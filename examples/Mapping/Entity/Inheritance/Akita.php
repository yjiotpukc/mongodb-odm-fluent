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
class Akita extends PedigreeDog
{
    /** @Field(type="string") */
    private string $akitaPrivate;
    /** @Field(type="string") */
    protected string $akitaProtected;
    /** @Field(type="string") */
    public string $akitaPublic;

    public static function loadMetadata(ClassMetadata $classMetadata): void
    {
        $builder = new DocumentBuilder();
        $builder->string('akitaPrivate');
        $builder->string('akitaProtected');
        $builder->string('akitaPublic');
        $builder->build($classMetadata);
    }
}
