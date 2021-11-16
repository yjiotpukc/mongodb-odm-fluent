<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type\Id;

interface IdAlNum
{
    public function type(string $type): IdAlNum;

    public function nullable(): IdAlNum;

    public function notSaved(): IdAlNum;

    public function pad(int $padding): IdAlNum;

    public function chars(string $chars): IdAlNum;

    public function awkwardSafeMode(): IdAlNum;
}
