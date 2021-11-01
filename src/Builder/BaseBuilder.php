<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Buildable\Buildable;
use yjiotpukc\MongoODMFluent\Buildable\Id as IdImplementation;
use yjiotpukc\MongoODMFluent\Type\Id;

abstract class BaseBuilder implements Buildable
{
    /**
     * @var Buildable[]
     */
    protected $buildables = [];

    public function build(ClassMetadata $metadata): void
    {
        foreach ($this->buildables as $buildable) {
            $buildable->build($metadata);
        }
    }

    public function id(): Id
    {
        return $this->addBuildable(new IdImplementation());
    }

    protected function addBuildable($buildable)
    {
        $this->buildables[] = $buildable;

        return $buildable;
    }
}
