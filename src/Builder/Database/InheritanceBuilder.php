<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Database;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Builder;

class InheritanceBuilder implements Builder
{
    protected int $type;

    public function __construct(int $type)
    {
        $this->type = $type;
    }

    public static function singleCollection(): self
    {
        return new static(ClassMetadata::INHERITANCE_TYPE_SINGLE_COLLECTION);
    }

    public static function collectionPerClass(): self
    {
        return new static(ClassMetadata::INHERITANCE_TYPE_COLLECTION_PER_CLASS);
    }

    public function build(ClassMetadata $metadata): void
    {
        $metadata->setInheritanceType($this->type);
    }
}
