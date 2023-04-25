<?php

declare(strict_types=1);

namespace Examples\Entity\Inheritance;

class Akita extends PedigreeDog
{
    private string $akitaPrivate;
    protected string $akitaProtected;
    public string $akitaPublic;
}
