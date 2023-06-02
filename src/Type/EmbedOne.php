<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type;

interface EmbedOne
{
    public function target(string $target): EmbedOne;

    public function nullable(): EmbedOne;

    public function notSaved(): EmbedOne;

    public function discriminator(string $field): Discriminator;
}
