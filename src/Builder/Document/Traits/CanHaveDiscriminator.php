<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document\Traits;

use yjiotpukc\MongoODMFluent\Builder\Database\Discriminator;

trait CanHaveDiscriminator
{
    public function discriminator(string $field): \yjiotpukc\MongoODMFluent\Type\Discriminator
    {
        return $this->addBuilder(new Discriminator($field));
    }
}
