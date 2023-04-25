<?php

declare(strict_types=1);

namespace Examples\Document;

use Examples\Entity\ImageMetadata;
use yjiotpukc\MongoODMFluent\Document\File;
use yjiotpukc\MongoODMFluent\Mapping\FileMapping;

class ImageDoc implements File
{
    public static function map(FileMapping $mapping): void
    {
        $mapping->db('dbName');
        $mapping->bucket('images');
        $mapping->id();
        $mapping->metadata()->target(ImageMetadata::class);
    }
}
