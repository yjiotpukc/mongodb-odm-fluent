<?php

declare(strict_types=1);

namespace Examples\Entity\Id;

use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;

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
}
