<?php

declare(strict_types=1);

namespace Examples\Entity\Inheritance;

class Reptile extends Animal
{
    private string $reptilePrivate;
    protected string $reptileProtected;
    public string $reptilePublic;
}
