<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Mapping;

use yjiotpukc\MongoODMFluent\Fluent\Fluent;

interface Mapping
{
    /**
     * Returns Entity name
     *
     * @return string
     */
    public function mapFor(): string;

    /**
     * Maps Entity's properties to MongoDB fields
     *
     * @param Fluent $builder
     */
    public function map(Fluent $builder): void;

    /**
     * Returns whether the class with the specified name should have its metadata loaded.
     * This is only the case if it is either mapped as an Entity or a MappedSuperclass.
     *
     * @return bool
     */
    public function isTransient(): bool;
}
