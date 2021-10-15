<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type;

interface Index
{
    public function __construct($keys = []);

    public function asc(string $key): Index;

    public function desc(string $key = ''): Index;

    public function unique(): Index;

    public function name(string $name): Index;

    public function background(): Index;

    public function expireAfter(int $seconds): Index;

    public function sparse(): Index;

    public function partialFilter(string $expression): Index;
}
