<?php

declare(strict_types=1);

namespace Examples\Entity\Inheritance;

class Pomeranian extends PedigreeDog
{
    private string $pomeranianPrivate;
    protected string $pomeranianProtected;
    public string $pomeranianPublic;
}
