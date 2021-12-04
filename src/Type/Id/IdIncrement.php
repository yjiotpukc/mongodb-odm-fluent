<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type\Id;

interface IdIncrement
{
    public function type(string $type): IdIncrement;

    public function nullable(): IdIncrement;

    public function notSaved(): IdIncrement;

    public function key(string $key): IdIncrement;

    public function collection(string $collection): IdIncrement;

    public function startingId(int $startingId): IdIncrement;
}
