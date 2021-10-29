<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Traits;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Type\Implementation\Index as IndexImplementation;
use yjiotpukc\MongoODMFluent\Type\Index;

trait CanHaveIndex
{
    /**
     * @var Index[]
     */
    protected $indexes = [];

    /**
     * @param string|string[] $keys
     * @return Index
     */
    public function index($keys = []): Index
    {
        $index = new IndexImplementation($keys);
        $this->indexes[] = $index;

        return $index;
    }

    protected function buildIndex(ClassMetadata $metadata)
    {
        foreach ($this->indexes as $index) {
            $metadata->addIndex($index->keys, $index->options);
        }
    }
}
