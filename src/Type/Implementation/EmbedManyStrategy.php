<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type\Implementation;

use yjiotpukc\MongoODMFluent\Type\EmbedMany as EmbedManyType;

class EmbedManyStrategy implements \yjiotpukc\MongoODMFluent\Type\EmbedManyStrategy
{
    public $embedMany;

    /**
     * @var string
     */
    public $strategy;

    public function __construct(EmbedMany $embedMany)
    {
        $this->embedMany = $embedMany;
    }

    public function addToSet(): EmbedManyType
    {
        $this->strategy = 'addToSet';

        return $this->embedMany;
    }

    public function pushAll(): EmbedManyType
    {
        $this->strategy = 'pushAll';

        return $this->embedMany;
    }

    public function set(): EmbedManyType
    {
        $this->strategy = 'set';

        return $this->embedMany;
    }

    public function setArray(): EmbedManyType
    {
        $this->strategy = 'setArray';

        return $this->embedMany;
    }
}
