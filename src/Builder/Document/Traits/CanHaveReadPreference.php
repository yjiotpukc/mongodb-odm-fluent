<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document\Traits;

use yjiotpukc\MongoODMFluent\Builder\Database\ReadPreferenceBuilder;
use yjiotpukc\MongoODMFluent\Type\ReadPreferenceMode;

trait CanHaveReadPreference
{
    public function readPreference(): ReadPreferenceMode
    {
        return $this->addBuilder(new ReadPreferenceBuilder());
    }
}
