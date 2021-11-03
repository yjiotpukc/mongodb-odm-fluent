<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document\Traits;

use yjiotpukc\MongoODMFluent\Buildable\WriteConcern;

trait CanHaveWriteConcern
{
    /**
     * @param int|string|null $writeConcern
     */
    public function writeConcern($writeConcern): self
    {
        return $this->addBuildableAndReturnSelf(new WriteConcern($writeConcern));
    }
}
