<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\FluentBuilderFactory;

use yjiotpukc\MongoODMFluent\Fluent\Fluent;
use yjiotpukc\MongoODMFluent\Fluent\FluentBuilder;
use yjiotpukc\MongoODMFluent\Mapping\Mapping;

interface FluentBuilderFactory extends Fluent
{
    /**
     * Create builder for a mapping
     *
     * @param Mapping $mapping
     * @return FluentBuilder
     */
    public function createBuilder(Mapping $mapping): FluentBuilder;
}
