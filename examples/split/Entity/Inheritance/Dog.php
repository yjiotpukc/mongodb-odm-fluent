<?php

declare(strict_types=1);

namespace Examples\Entity\Inheritance;

class Dog extends Mammal
{
    private string $dogPrivate;
    protected string $dogProtected;
    public string $dogPublic;
}
