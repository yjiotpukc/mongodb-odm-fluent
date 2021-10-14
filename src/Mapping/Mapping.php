<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Mapping;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;

interface Mapping
{
    /**
     * Returns Entity name
     *
     * @return string
     */
    public function mapFor(): string;

    public function load(ClassMetadata $metadata): void;

    /**
     * Returns whether the class with the specified name should have its metadata loaded.
     * This is only the case if it is either mapped as an Entity or a MappedSuperclass.
     *
     * @return bool
     */
    public function isTransient(): bool;

    /**
     * Returns fluent builder for this mapping type
     */
    public function createBuilder();
}
