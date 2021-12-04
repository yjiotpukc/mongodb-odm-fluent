<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type;

interface FileMetadata
{
    public function fieldName(string $name): FileMetadata;

    public function target(string $target): FileMetadata;

    public function discriminator(string $field): Discriminator;
}
