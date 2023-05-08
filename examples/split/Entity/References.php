<?php

declare(strict_types=1);

namespace Examples\Entity;


use Doctrine\Common\Collections\Collection;
use Examples\Collection\EntityCollection;

class References
{
    private string $id;
    private References $parent;
    private Collection $children;
    private Entity $ref1;
    private Entity $ref2;
    private Collection $ref3;
    private Collection $ref4;
    private Collection $ref5;
    private Collection $ref6;
    private Entity $ref7;
    private EntityCollection $ref8;
    private Collection $ref9;
    private Collection $ref10;
    private Collection $ref11;
    private Collection $ref12;
    private Collection $ref13;
    private Collection $ref14;
    private Collection $ref15;
    private Collection $ref16;
}
