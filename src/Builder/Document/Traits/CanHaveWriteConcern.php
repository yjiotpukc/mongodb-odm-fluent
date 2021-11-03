<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document\Traits;

use yjiotpukc\MongoODMFluent\Builder\Database\WriteConcern;

trait CanHaveWriteConcern
{
    /**
     * @param int|string|null $writeConcern
     */
    public function writeConcern($writeConcern): self
    {
        return $this->addBuilderAndReturnSelf(new WriteConcern($writeConcern));
    }
}
