<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Traits;

use yjiotpukc\MongoODMFluent\Buildable\Id as IdImplementation;
use yjiotpukc\MongoODMFluent\Type\Id;

trait CanHaveIds
{
    use AbstractBuilderTrait;

    public function id(): Id
    {
        return $this->addBuildable(new IdImplementation());
    }
}
