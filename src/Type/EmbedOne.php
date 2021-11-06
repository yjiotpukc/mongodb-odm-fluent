<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type;

interface EmbedOne
{
    public function __construct(string $fieldName, string $target);

    public function target(string $target): EmbedOne;

    public function notSaved(): EmbedOne;

    public function discriminator(string $field): Discriminator;
}
