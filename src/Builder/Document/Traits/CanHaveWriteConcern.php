<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document\Traits;

use yjiotpukc\MongoODMFluent\Builder\Database\WriteConcernBuilder;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;

trait CanHaveWriteConcern
{
    /**
     * @param int|string|null $writeConcern
     */
    public function writeConcern($writeConcern): DocumentBuilder
    {
        return $this->addBuilderAndReturnSelf(new WriteConcernBuilder($writeConcern));
    }
}
