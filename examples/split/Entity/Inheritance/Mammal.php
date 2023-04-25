<?php

declare(strict_types=1);

namespace Examples\Entity\Inheritance;

class Mammal extends Animal
{
    private string $mammalPrivate;
    protected string $mammalProtected;
    public string $mammalPublic;
}
