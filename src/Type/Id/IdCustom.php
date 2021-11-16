<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type\Id;

interface IdCustom
{
    public function type(string $type): IdCustom;

    public function nullable(): IdCustom;

    public function notSaved(): IdCustom;

    public function generatorOption(string $key, string $value): IdCustom;
}
