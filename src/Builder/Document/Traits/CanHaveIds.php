<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document\Traits;

use yjiotpukc\MongoODMFluent\Builder\Field\IdBuilder;
use yjiotpukc\MongoODMFluent\Type\Id\Id;

trait CanHaveIds
{
    public function id(): Id
    {
        return $this->addBuilder(new IdBuilder());
    }
}
