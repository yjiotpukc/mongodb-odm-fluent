<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document\Traits;

use yjiotpukc\MongoODMFluent\Builder\Database\DbBuilder;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;

trait CanHaveDb
{
    public function db(string $name): DocumentBuilder
    {
        return $this->addBuilderAndReturnSelf(new DbBuilder($name));
    }
}
