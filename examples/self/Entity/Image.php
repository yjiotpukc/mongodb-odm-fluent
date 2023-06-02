<?php

declare(strict_types=1);

namespace Examples\Entity;

use DateTime;
use Examples\Repository\ImageRepository;
use yjiotpukc\MongoODMFluent\Document\File;
use yjiotpukc\MongoODMFluent\Mapping\FileMapping;

class Image implements File
{
    protected string $id;
    protected string $customFilename;
    protected DateTime $customUploadDate;
    protected int $customLength;
    protected int $customChunkSize;
    protected ImageMetadata $customMetadata;

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
