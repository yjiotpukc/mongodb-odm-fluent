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
class Pomeranian extends PedigreeDog
{
    /** @Field(type="string") */
    private string $pomeranianPrivate;
    /** @Field(type="string") */
    protected string $pomeranianProtected;
    /** @Field(type="string") */
    public string $pomeranianPublic;

    public static function loadMetadata(ClassMetadata $classMetadata): void
    {
        $builder = new DocumentBuilder();
        $builder->string('pomeranianPrivate');
        $builder->string('pomeranianProtected');
        $builder->string('pomeranianPublic');
        $builder->build($classMetadata);
    }
}
