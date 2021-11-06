<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document\Traits;

use yjiotpukc\MongoODMFluent\Builder\Database\IndexBuilder;
use yjiotpukc\MongoODMFluent\Type\Index;

trait CanHaveIndex
{
    /**
     * @param string|string[] $keys
     * @return Index
     */
    public function index($keys = []): Index
    {
        return $this->addBuilder(new IndexBuilder($keys));
    }
}
