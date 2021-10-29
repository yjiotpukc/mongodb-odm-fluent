<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Traits;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Type\Discriminator;

trait CanHaveDiscriminator
{
    /**
     * @var Discriminator
     */
    protected $discriminator;

    public function discriminator(Discriminator $discriminator): self
    {
        $this->discriminator = $discriminator;

        return $this;
    }

    protected function buildDiscriminator(ClassMetadata $metadata)
    {
        if ($this->discriminator) {
            $metadata->setDiscriminatorField($this->discriminator->field);
            $metadata->setDiscriminatorMap($this->discriminator->map);
            $metadata->setDefaultDiscriminatorValue($this->discriminator->defaultValue);
        }
    }
}
