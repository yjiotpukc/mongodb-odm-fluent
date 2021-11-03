<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document\Traits;

use yjiotpukc\MongoODMFluent\Builder\Field\Id as IdImplementation;
use yjiotpukc\MongoODMFluent\Type\Id;

trait CanHaveIds
{
    public function id(): Id
    {
        return $this->addBuilder(new IdImplementation());
    }
}
