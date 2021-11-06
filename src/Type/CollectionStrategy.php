<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type;

interface CollectionStrategy
{
    public function addToSet(): CollectionStrategy;

    public function pushAll(): CollectionStrategy;

    public function set(): CollectionStrategy;

    public function setArray(): CollectionStrategy;
}
