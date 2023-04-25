<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Field;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Builder;

abstract class AbstractField implements Builder
{
    protected string $fieldName;

    public function build(ClassMetadata $metadata): void
    {
        if (!$metadata->getReflectionClass()->hasProperty($this->fieldName)) {
            return;
        }

        $reflProperty = $metadata->getReflectionClass()->getProperty($this->fieldName);
        if (!$metadata->isMappedSuperclass || $reflProperty->isPrivate()) {
            $metadata->mapField($this->map());
        }
    }

    abstract public function map(): array;
}
