<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Document;

interface View
{
    public function map(\yjiotpukc\MongoODMFluent\Builder\View $builder): void;
}
