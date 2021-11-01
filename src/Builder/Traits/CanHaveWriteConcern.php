<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Traits;

use yjiotpukc\MongoODMFluent\Buildable\WriteConcern;

trait CanHaveWriteConcern
{
    use AbstractBuilderTrait;

    /**
     * @param int|string|null $writeConcern
     */
    public function writeConcern($writeConcern): self
    {
        $this->addBuildable(new WriteConcern($writeConcern));

        return $this;
    }
}
