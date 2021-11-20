<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type\Id;

interface Id
{
    public function type(string $type): Id;

    public function fieldName(string $fieldName): Id;

    public function nullable(): Id;

    public function notSaved(): Id;

    public function alNum(): IdAlNum;

    public function increment(): IdIncrement;

    public function uuid(): IdUuid;

    public function none(): IdNone;

    public function custom(string $generatorClassName): IdCustom;
}
