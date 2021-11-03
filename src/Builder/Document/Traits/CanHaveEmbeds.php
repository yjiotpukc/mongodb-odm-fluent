<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document\Traits;

use yjiotpukc\MongoODMFluent\Buildable\EmbedMany as EmbedManyImplementation;
use yjiotpukc\MongoODMFluent\Buildable\EmbedOne as EmbedOneImplementation;
use yjiotpukc\MongoODMFluent\Type\EmbedMany;
use yjiotpukc\MongoODMFluent\Type\EmbedOne;

trait CanHaveEmbeds
{
    public function embedOne(string $fieldName, string $target = ''): EmbedOne
    {
        return $this->addBuildable(new EmbedOneImplementation($fieldName, $target));
    }

    public function embedMany(string $fieldName, string $target = ''): EmbedMany
    {
        return $this->addBuildable(new EmbedManyImplementation($fieldName, $target));
    }
}
