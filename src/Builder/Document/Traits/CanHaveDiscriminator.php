<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document\Traits;

use yjiotpukc\MongoODMFluent\Builder\Database\DiscriminatorBuilder;
use yjiotpukc\MongoODMFluent\Type\Discriminator;

trait CanHaveDiscriminator
{
    public function discriminator(string $field): Discriminator
    {
        return $this->addBuilder(new DiscriminatorBuilder($field));
    }
}
