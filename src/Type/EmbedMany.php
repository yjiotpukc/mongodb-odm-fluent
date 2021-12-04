<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type;

interface EmbedMany
{
    public function __construct(string $fieldName, string $target);

    public function target(string $target): EmbedMany;

    public function nullable(): EmbedMany;

    public function notSaved(): EmbedMany;

    public function discriminator(string $field): Discriminator;

    public function collectionClass(string $className): EmbedMany;

    public function strategy(): CollectionStrategy;
}
