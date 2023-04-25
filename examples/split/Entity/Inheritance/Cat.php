<?php

declare(strict_types=1);

namespace Examples\Entity\Inheritance;

class Cat extends Mammal
{
    private string $catPrivate;
    protected string $catProtected;
    public string $catPublic;
}
