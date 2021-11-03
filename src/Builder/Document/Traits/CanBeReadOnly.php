<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document\Traits;

use yjiotpukc\MongoODMFluent\Buildable\ReadOnly;

trait CanBeReadOnly
{
    public function readOnly(): self
    {
        return $this->addBuildableAndReturnSelf(new ReadOnly());
    }
}
