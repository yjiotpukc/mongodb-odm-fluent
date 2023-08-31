<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Examples\Mapping\Entity;

use Doctrine\ODM\MongoDB\Mapping\Annotations\EmbeddedDocument;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;

/** @EmbeddedDocument */
class Embedded
{
    /** @Field(type="float") */
    private float $latitude;
    /** @Field(type="float") */
    private float $longitude;

    public static function loadMetadata(ClassMetadata $classMetadata): void
    {
        $builder = new DocumentBuilder();
        $builder->embeddedDocument();
        $builder->float('latitude');
        $builder->float('longitude');
        $builder->build($classMetadata);
    }
}
