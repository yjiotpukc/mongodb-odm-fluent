<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Examples\Mapping\Entity\Id;

use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;

/** @Document */
class Increment
{
    /**
     * @Id(
     *     strategy="increment",
     *     type="int",
     *     options={
     *         "startingId"=10,
     *         "collection"="someCollection",
     *         "key"="someKey"
     *     }
     * )
     */
    private int $id;

    public static function loadMetadata(ClassMetadata $classMetadata): void
    {
        $builder = new DocumentBuilder();
        $builder->id()
            ->increment()
            ->startingId(10)
            ->collection('someCollection')
            ->key('someKey');
        $builder->build($classMetadata);
    }
}
