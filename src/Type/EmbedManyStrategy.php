<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type;

interface EmbedManyStrategy
{
    public function addToSet(): EmbedMany;

    public function pushAll(): EmbedMany;

    public function set(): EmbedMany;

    public function setArray(): EmbedMany;
}
