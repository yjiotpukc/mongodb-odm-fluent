<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Examples\Mapping\Entity\ReadPreference;

use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use Doctrine\ODM\MongoDB\Mapping\Annotations\ReadPreference;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;

/**
 * @Document
 * @ReadPreference("primaryPreferred")
 */
class PrimaryPreferred
{
    /** @Id */
    private string $id;

    public static function loadMetadata(ClassMetadata $classMetadata): void
    {
        $builder = new DocumentBuilder();
        $builder->id();
        $builder->readPreference()->primaryPreferred();
        $builder->build($classMetadata);
    }
}