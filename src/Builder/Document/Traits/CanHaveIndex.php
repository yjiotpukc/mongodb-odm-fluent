<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document\Traits;

use yjiotpukc\MongoODMFluent\Buildable\Index as IndexImplementation;
use yjiotpukc\MongoODMFluent\Type\Index;

trait CanHaveIndex
{
    /**
     * @param string|string[] $keys
     * @return Index
     */
    public function index($keys = []): Index
    {
        return $this->addBuildable(new IndexImplementation($keys));
    }
}
