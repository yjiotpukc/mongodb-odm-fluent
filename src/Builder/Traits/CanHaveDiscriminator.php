<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Traits;

use yjiotpukc\MongoODMFluent\Type\Discriminator;

trait CanHaveDiscriminator
{
    use AbstractBuilderTrait;

    public function discriminator(Discriminator $discriminator): self
    {
        $this->addBuildable($discriminator);

        return $this;
    }
}
