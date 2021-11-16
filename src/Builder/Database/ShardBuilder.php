<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Database;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Builder;
use yjiotpukc\MongoODMFluent\Type\Shard;

class ShardBuilder implements Builder, Shard
{
    protected array $keys = [];
    protected ?bool $unique = null;
    protected ?int $numInitialChunks = null;

    public function asc(string $key): Shard
    {
        $this->keys[$key] = 'asc';

        return $this;
    }

    public function desc(string $key): Shard
    {
        $this->keys[$key] = 'desc';

        return $this;
    }

    public function unique(): Shard
    {
        $this->unique = true;

        return $this;
    }

    public function numInitialChunks(int $chunks): Shard
    {
        $this->numInitialChunks = $chunks;

        return $this;
    }

    public function build(ClassMetadata $metadata): void
    {
        $metadata->setShardKey($this->keys, $this->getOptions());
    }

    protected function getOptions(): array
    {
        $options = [];
        if ($this->unique) {
            $options['unique'] = $this->unique;
        }
        if ($this->numInitialChunks) {
            $options['numInitialChunks'] = $this->numInitialChunks;
        }

        return $options;
    }
}
