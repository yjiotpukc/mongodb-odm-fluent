<?php

declare(strict_types=1);

namespace Examples\Entity\Inheritance;

class Animal
{
    protected string $id;
    private string $animalPrivate;
    protected string $animalProtected;
    public string $animalPublic;
}
