<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document\Traits;

use yjiotpukc\MongoODMFluent\Builder\Database\ReadOnlyBuilder;

trait CanBeReadOnly
{
    public function readOnly(): self
    {
        return $this->addBuilderAndReturnSelf(new ReadOnlyBuilder());
    }
}
