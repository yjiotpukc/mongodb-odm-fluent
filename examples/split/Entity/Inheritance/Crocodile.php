<?php

declare(strict_types=1);

namespace Examples\Entity\Inheritance;

class Crocodile extends Reptile
{
    private string $crocodilePrivate;
    protected string $crocodileProtected;
    public string $crocodilePublic;
}
