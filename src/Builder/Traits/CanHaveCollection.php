<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Traits;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;

trait CanHaveCollection
{
    /**
     * @var string
     */
    protected $collection;

    public function collection(string $name): self
    {
        $this->collection = $name;

        return $this;
    }

    protected function buildCollection(ClassMetadata $metadata)
    {
        if ($this->collection) {
            $metadata->setCollection($this->collection);
        }
    }
}
