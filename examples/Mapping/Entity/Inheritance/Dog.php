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
class Dog extends Mammal
{
    /** @Field(type="string") */
    private string $dogPrivate;
    /** @Field(type="string") */
    protected string $dogProtected;
    /** @Field(type="string") */
    public string $dogPublic;

    public static function loadMetadata(ClassMetadata $classMetadata): void
    {
        $builder = new DocumentBuilder();
        $builder->string('dogPrivate');
        $builder->string('dogProtected');
        $builder->string('dogPublic');
        $builder->build($classMetadata);
    }
}
