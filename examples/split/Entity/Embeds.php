<?php

declare(strict_types=1);

namespace Examples\Entity;

use Examples\Collection\EmbeddedCollection;
use MongoDB\Collection;

class Embeds
{
    private string $id;
    private Embedded $ref1;
    private Embedded $ref2;
    private Collection $ref3;
    private Collection $ref4;
    private Collection $ref5;
    private Collection $ref6;
    private Embedded $ref7;
    private EmbeddedCollection $ref8;
    private Collection $ref9;
    private Collection $ref10;
    private Collection $ref11;
    private Collection $ref12;
    private Collection $ref13;
    private Collection $ref14;
}
