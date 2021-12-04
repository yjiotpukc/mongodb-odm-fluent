<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Database;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Builder;

class ViewNameBuilder implements Builder
{
    protected string $view;

    public function __construct(string $name)
    {
        $this->view = $name;
    }

    public function build(ClassMetadata $metadata): void
    {
        $metadata->setCollection($this->view);
    }
}
