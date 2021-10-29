<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Stubs;

use yjiotpukc\MongoODMFluent\Builder\BaseBuilder;

class BaseBuilderStub extends BaseBuilder
{
    public function getFields(): array
    {
        return $this->fields;
    }
}
