<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Examples\Mapping\Entity\ChangeTrackingPolicy;

use Doctrine\ODM\MongoDB\Mapping\Annotations\ChangeTrackingPolicy;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;

/**
 * @Document
 * @ChangeTrackingPolicy("DEFERRED_IMPLICIT")
 */
class DeferredImplicit
{
    /** @Id */
    private string $id;

    public static function loadMetadata(ClassMetadata $classMetadata): void
    {
        $builder = new DocumentBuilder();
        $builder->id();
        $builder->changeTrackingPolicy()->deferredImplicit();
        $builder->build($classMetadata);
    }
}