<?php

declare(strict_types=1);

namespace Examples\Entity\Id;

use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use Examples\IdGenerator\CustomIdGenerator;

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
}
