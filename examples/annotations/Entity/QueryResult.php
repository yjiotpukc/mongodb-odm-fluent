<?php

declare(strict_types=1);

namespace Examples\Entity;

use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;
use Doctrine\ODM\MongoDB\Mapping\Annotations\QueryResultDocument;

/** @QueryResultDocument */
class QueryResult
{
    /** @Field(type="int") */
    private int $count;
}
