<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Database;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Builder;
use yjiotpukc\MongoODMFluent\Type\Discriminator as DiscriminatorType;

class Discriminator implements Builder
{
    /**
     * @var DiscriminatorType
     */
    protected $discriminator;

    public function __construct(DiscriminatorType $discriminator)
    {
        $this->discriminator = $discriminator;
    }

    public function build(ClassMetadata $metadata): void
    {
        $metadata->setDiscriminatorField($this->discriminator->field);
        $metadata->setDiscriminatorMap($this->discriminator->map);
        $metadata->setDefaultDiscriminatorValue($this->discriminator->defaultValue);
    }
}
