<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type;

interface Cascade
{
    public function all(): Cascade;

    public function detach(): Cascade;

    public function merge(): Cascade;

    public function refresh(): Cascade;

    public function remove(): Cascade;

    public function persist(): Cascade;
}
