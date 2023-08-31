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
class Crocodile extends Reptile
{
    /** @Field(type="string") */
    private string $crocodilePrivate;
    /** @Field(type="string") */
    protected string $crocodileProtected;
    /** @Field(type="string") */
    public string $crocodilePublic;

    public static function loadMetadata(ClassMetadata $classMetadata): void
    {
        $builder = new DocumentBuilder();
        $builder->string('crocodilePrivate');
        $builder->string('crocodileProtected');
        $builder->string('crocodilePublic');
        $builder->build($classMetadata);
    }
}
