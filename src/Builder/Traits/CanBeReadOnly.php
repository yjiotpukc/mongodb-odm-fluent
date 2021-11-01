<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Traits;

use yjiotpukc\MongoODMFluent\Buildable\ReadOnly;

trait CanBeReadOnly
{
    use AbstractBuilderTrait;

    public function readOnly(): self
    {
        $this->addBuildable(new ReadOnly());

        return $this;
    }
}
