<?php

declare(strict_types=1);

namespace Examples\Document;

use Examples\Entity\ImageMetadata;
use Examples\Repository\ImageRepository;
use yjiotpukc\MongoODMFluent\Document\File;
use yjiotpukc\MongoODMFluent\Mapping\FileMapping;

class ImageDoc implements File
{
    public static function map(FileMapping $mapping): void
    {
        $mapping->db('dbName');
        $mapping->bucket('images');
        $mapping->repository(ImageRepository::class);
        $mapping->readOnly();
        $mapping->readPreference()->nearest();
        $mapping->chunkSize(8192);
        $mapping->writeConcern('majority');
        $mapping->id();
        $mapping->filenameFieldName('customFilename');
        $mapping->uploadDateFieldName('customUploadDate');
        $mapping->lengthFieldName('customLength');
        $mapping->chunkSizeFieldName('customChunkSize');
        $mapping->metadata()->fieldName('customMetadata')->target(ImageMetadata::class);
        $mapping->index('filename');
        $mapping->shard()->asc('filename');
    }
}
