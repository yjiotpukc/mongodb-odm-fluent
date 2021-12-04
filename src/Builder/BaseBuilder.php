<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;

abstract class BaseBuilder implements Builder
{
    /** @var Builder[] */
    protected array $builders = [];

    public function build(ClassMetadata $metadata): void
    {
        foreach ($this->builders as $builder) {
            $builder->build($metadata);
        }
    }

    protected function addBuilder($builder)
    {
        $this->builders[] = $builder;

        return $builder;
    }

    protected function addBuilderAndReturnSelf($builder): self
    {
        $this->builders[] = $builder;

        return $this;
    }
}
