<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Examples\Mapping\Entity\Id;

use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;

/**
 * @Document
 */
class AlNum
{
    /**
     * @Id(
     *     strategy="alNum",
     *     options={
     *         "awkwardSafe"=true,
     *         "pad"=5,
     *         "chars"="abcdefg"
     *     }
     * )
     */
    private string $id;

    public static function loadMetadata(ClassMetadata $classMetadata): void
    {
        $builder = new DocumentBuilder();
        $builder->id()
            ->alNum()
            ->awkwardSafeMode()
            ->pad(5)
            ->chars('abcdefg');
        $builder->build($classMetadata);
    }
}
