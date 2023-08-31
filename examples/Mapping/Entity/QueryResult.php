<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Examples\Mapping\Entity;

use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;
use Doctrine\ODM\MongoDB\Mapping\Annotations\QueryResultDocument;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;

/** @QueryResultDocument */
class QueryResult
{
    /** @Field(type="int") */
    private int $count;

    public static function loadMetadata(ClassMetadata $classMetadata): void
    {
        $builder = new DocumentBuilder();
        $builder->queryResultDocument();
        $builder->int('count');
        $builder->build($classMetadata);
    }
}
