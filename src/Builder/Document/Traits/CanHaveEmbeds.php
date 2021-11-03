<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document\Traits;

use yjiotpukc\MongoODMFluent\Builder\Field\EmbedMany as EmbedManyImplementation;
use yjiotpukc\MongoODMFluent\Builder\Field\EmbedOne as EmbedOneImplementation;
use yjiotpukc\MongoODMFluent\Type\EmbedMany;
use yjiotpukc\MongoODMFluent\Type\EmbedOne;

trait CanHaveEmbeds
{
    public function embedOne(string $fieldName, string $target = ''): EmbedOne
    {
        return $this->addBuilder(new EmbedOneImplementation($fieldName, $target));
    }

    public function embedMany(string $fieldName, string $target = ''): EmbedMany
    {
        return $this->addBuilder(new EmbedManyImplementation($fieldName, $target));
    }
}
