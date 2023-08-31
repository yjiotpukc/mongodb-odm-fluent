<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Examples\Mapping\Entity\Id;

use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;
use yjiotpukc\MongoODMFluent\Examples\Mapping\IdGenerator\CustomIdGenerator;

/** @Document */
class Custom
{
    /**
     * @Id(
     *     type="string",
     *     strategy="custom",
     *     options={
     *         "class"=CustomIdGenerator::class,
     *         "prefix"="pre-",
     *         "postfix"="-post",
     *     }
     * )
     */
    private string $id;

    public static function loadMetadata(ClassMetadata $classMetadata): void
    {
        $builder = new DocumentBuilder();
        $builder->id()
            ->custom(CustomIdGenerator::class)
            ->type('string')
            ->generatorOption('prefix', 'pre-')
            ->generatorOption('postfix', '-post');
        $builder->build($classMetadata);
    }
}
