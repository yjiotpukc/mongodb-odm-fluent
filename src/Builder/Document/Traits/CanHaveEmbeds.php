<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document\Traits;

use yjiotpukc\MongoODMFluent\Builder\Field\EmbedManyBuilder;
use yjiotpukc\MongoODMFluent\Builder\Field\EmbedOneBuilder;
use yjiotpukc\MongoODMFluent\Type\EmbedMany;
use yjiotpukc\MongoODMFluent\Type\EmbedOne;

trait CanHaveEmbeds
{
    public function embedOne(string $fieldName, string $target = ''): EmbedOne
    {
        return $this->addBuilder(new EmbedOneBuilder($fieldName, $target));
    }

    public function embedMany(string $fieldName, string $target = ''): EmbedMany
    {
        return $this->addBuilder(new EmbedManyBuilder($fieldName, $target));
    }
}
