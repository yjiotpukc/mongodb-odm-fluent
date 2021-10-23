<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type;

use yjiotpukc\MongoODMFluent\Type\ValueObject\CollectionStrategy;

interface EmbedMany
{
    public function __construct(string $fieldName, string $target);

    public function target(string $target): EmbedMany;

    public function notSaved(): EmbedMany;

    public function discriminator(Discriminator $discriminator): EmbedMany;

    public function collectionClass(string $className): EmbedMany;

    public function strategy(CollectionStrategy $strategy): EmbedMany;
}
