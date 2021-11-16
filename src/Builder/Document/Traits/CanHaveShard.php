<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document\Traits;

use yjiotpukc\MongoODMFluent\Builder\Database\ShardBuilder;
use yjiotpukc\MongoODMFluent\Type\Shard;

trait CanHaveShard
{
    public function shard(): Shard
    {
        return $this->addBuilder(new ShardBuilder());
    }
}
