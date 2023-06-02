<?php

declare(strict_types=1);

namespace Examples\Entity;

use Doctrine\ODM\MongoDB\Mapping\Annotations\AlsoLoad;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;

/** @Document(readOnly=true, writeConcern="majority") */
class Misc
{
    /** @Id() */
    private string $id;

    /** @AlsoLoad("field") */
    public function alsoLoad(string $field): void
    {
    }
}
