<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type;

class CollectionStrategy
{
    public $strategy;

    public function addToSet(): CollectionStrategy
    {
        $this->strategy = 'addToSet';

        return $this;
    }

    public function pushAll(): CollectionStrategy
    {
        $this->strategy = 'pushAll';

        return $this;
    }

    public function set(): CollectionStrategy
    {
        $this->strategy = 'set';

        return $this;
    }

    public function setArray(): CollectionStrategy
    {
        $this->strategy = 'setArray';

        return $this;
    }
}
