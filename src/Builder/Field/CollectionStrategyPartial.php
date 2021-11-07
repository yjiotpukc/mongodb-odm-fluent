<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Field;

use yjiotpukc\MongoODMFluent\Type\CollectionStrategy;

class CollectionStrategyPartial implements CollectionStrategy, FieldPartial
{
    protected string $strategy = 'pushAll';

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

    public function toMapping(): array
    {
        return ['strategy' => $this->strategy];
    }
}
