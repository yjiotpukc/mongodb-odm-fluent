<?php

namespace yjiotpukc\MongoODMFluent\Builder\Method;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Builder;

class AlsoLoadMethodBuilder implements Builder
{
    protected string $method;
    protected array $fields;

    public function __construct(string $method, array $fields)
    {
        $this->method = $method;
        $this->fields = $fields;
    }

    public function build(ClassMetadata $metadata): void
    {
        $metadata->registerAlsoLoadMethod($this->method, $this->fields);
    }
}