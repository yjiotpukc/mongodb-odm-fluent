<?php

declare(strict_types=1);

namespace Examples\Entity\Inheritance;

class Hatiko extends Akita
{
    private string $hatikoPrivate;
    protected string $hatikoProtected;
    public string $hatikoPublic;
}
