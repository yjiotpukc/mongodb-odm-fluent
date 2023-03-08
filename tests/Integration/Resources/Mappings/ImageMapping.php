<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Mappings;

use yjiotpukc\MongoODMFluent\Document\File;
use yjiotpukc\MongoODMFluent\Mapping\FileMapping;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\ImageMetadata;

class ImageMapping implements File
{
    public static function map(FileMapping $mapping): void
    {
        $mapping->db('dbName');
        $mapping->bucket('images');
        $mapping->id();
        $mapping->metadata()->target(ImageMetadata::class);
    }
}
