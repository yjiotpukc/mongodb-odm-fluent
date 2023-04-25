<?php

declare(strict_types=1);

namespace Examples\Entity\Inheritance;

class PedigreeDog extends Dog
{
    private string $pedigreeDogPrivate;
    protected string $pedigreeDogProtected;
    public string $pedigreeDogPublic;
}
