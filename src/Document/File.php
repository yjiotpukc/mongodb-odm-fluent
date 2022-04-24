<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Document;

interface File
{
    public function map(\yjiotpukc\MongoODMFluent\Builder\File $builder): void;
}
