<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document\Traits;

use yjiotpukc\MongoODMFluent\Type\Discriminator;

trait CanHaveDiscriminator
{
    public function discriminator(Discriminator $discriminator): self
    {
        return $this->addBuilderAndReturnSelf($discriminator);
    }
}
