<?php

declare(strict_types=1);

namespace Examples\Entity;

class Entity
{
    private string $id;
    private string $stringField;
    /** @var Embedded[] */
    private array $embeds;
}
