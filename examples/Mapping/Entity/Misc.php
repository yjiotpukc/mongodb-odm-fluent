<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Examples\Mapping\Entity;

use Doctrine\ODM\MongoDB\Mapping\Annotations\AlsoLoad;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;

/** @Document(readOnly=true, writeConcern="majority") */
class Misc
{
    /** @Id() */
    private string $id;

    /** @AlsoLoad("field") */
    public function alsoLoad(string $field): void
    {
    }

    public static function loadMetadata(ClassMetadata $classMetadata): void
    {
        $builder = new DocumentBuilder();
        $builder->id();
        $builder->readOnly();
        $builder->writeConcern('majority');
        $builder->alsoLoad('alsoLoad', ['field']);
        $builder->build($classMetadata);
    }
}
