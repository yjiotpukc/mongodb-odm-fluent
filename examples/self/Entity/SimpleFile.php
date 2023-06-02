<?php

declare(strict_types=1);

namespace Examples\Entity;

use DateTime;
use yjiotpukc\MongoODMFluent\Document\File;
use yjiotpukc\MongoODMFluent\Mapping\FileMapping;

class SimpleFile implements File
{
    protected string $id;
    protected string $filename;
    protected DateTime $uploadDate;
    protected int $length;
    protected int $chunkSize;
    protected ImageMetadata $metadata;

    public static function map(FileMapping $mapping): void
    {
        $mapping->db('dbName');
        $mapping->bucket('images');
        $mapping->id();
        $mapping->metadata()->target(ImageMetadata::class);
    }
}
