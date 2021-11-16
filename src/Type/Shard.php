<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type;

interface Shard
{
    public function asc(string $key): Shard;

    public function desc(string $key): Shard;

    public function unique(): Shard;

    public function numInitialChunks(int $chunks): Shard;
}
