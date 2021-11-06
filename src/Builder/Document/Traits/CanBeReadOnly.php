<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document\Traits;

use yjiotpukc\MongoODMFluent\Builder\Database\ReadOnlyBuilder;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;

trait CanBeReadOnly
{
    public function readOnly(): DocumentBuilder
    {
        return $this->addBuilderAndReturnSelf(new ReadOnlyBuilder());
    }
}
