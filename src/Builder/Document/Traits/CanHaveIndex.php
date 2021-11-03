<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document\Traits;

use yjiotpukc\MongoODMFluent\Builder\Database\Index as IndexImplementation;
use yjiotpukc\MongoODMFluent\Type\Index;

trait CanHaveIndex
{
    /**
     * @param string|string[] $keys
     * @return Index
     */
    public function index($keys = []): Index
    {
        return $this->addBuilder(new IndexImplementation($keys));
    }
}
