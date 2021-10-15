<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type;

interface Id
{
    public function type(string $type): Id;

    public function alNum(): Id;

    public function increment(): Id;

    public function uuid(): Id;

    public function none(): Id;

    public function custom(string $generatorClassName): Id;
}
