<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Traits;

use yjiotpukc\MongoODMFluent\Type\Discriminator;

trait CanHaveDiscriminator
{
    public function discriminator(Discriminator $discriminator): self
    {
        $this->addBuildable($discriminator);

        return $this;
    }

    abstract protected function addBuildable($buildable);
}
