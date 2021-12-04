<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type;

interface ReadPreference
{
    public function tagSpecification(array $tagDocument): ReadPreference;

    public function tagSet(array $tags): ReadPreference;

    public function any(): ReadPreference;
}
