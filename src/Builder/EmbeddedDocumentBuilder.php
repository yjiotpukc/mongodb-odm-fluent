<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Type\Index;

class EmbeddedDocumentBuilder extends BaseBuilder implements FluentBuilder
{
    /**
     * @var Index[]
     */
    protected $indexes;

    public function build(ClassMetadata $metadata): void
    {
        $metadata->isEmbeddedDocument = true;
        if ($this->indexes) {
            foreach ($this->indexes as $index) {
                $metadata->addIndex($index->keys, $index->options);
            }
        }

        parent::build($metadata);
    }

    /**
     * @param string|string[] $keys
     * @return Index
     */
    public function index($keys = []): Index
    {
        $index = new Index($keys);
        $this->indexes[] = $index;

        return $index;
    }
}
