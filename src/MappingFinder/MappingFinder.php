<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\MappingFinder;

use yjiotpukc\MongoODMFluent\MappingSet\MappingSet;

interface MappingFinder
{
    public function makeMappingSet(): MappingSet;
}
