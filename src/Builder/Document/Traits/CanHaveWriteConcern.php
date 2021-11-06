<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document\Traits;

use yjiotpukc\MongoODMFluent\Builder\Database\WriteConcernBuilder;

trait CanHaveWriteConcern
{
    /**
     * @param int|string|null $writeConcern
     */
    public function writeConcern($writeConcern): self
    {
        return $this->addBuilderAndReturnSelf(new WriteConcernBuilder($writeConcern));
    }
}
