<?php

declare(strict_types=1);

namespace Examples\Entity\Id;

use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;

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
}
