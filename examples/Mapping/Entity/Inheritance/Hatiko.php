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
class Hatiko extends Akita
{
    /** @Field(type="string") */
    private string $hatikoPrivate;
    /** @Field(type="string") */
    protected string $hatikoProtected;
    /** @Field(type="string") */
    public string $hatikoPublic;

    public static function loadMetadata(ClassMetadata $classMetadata): void
    {
        $builder = new DocumentBuilder();
        $builder->string('hatikoPrivate');
        $builder->string('hatikoProtected');
        $builder->string('hatikoPublic');
        $builder->build($classMetadata);
    }
}
