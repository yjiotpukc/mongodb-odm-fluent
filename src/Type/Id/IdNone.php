<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type\Id;

interface IdNone
{
    public function type(string $type): IdNone;

    public function nullable(): IdNone;

    public function notSaved(): IdNone;
}
