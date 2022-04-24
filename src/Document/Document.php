<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Document;

interface Document
{
    public function map(\yjiotpukc\MongoODMFluent\Builder\Document $builder): void;
}
