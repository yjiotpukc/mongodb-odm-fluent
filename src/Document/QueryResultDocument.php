<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Document;

interface QueryResultDocument
{
    public function map(\yjiotpukc\MongoODMFluent\Builder\QueryResultDocument $builder): void;
}
