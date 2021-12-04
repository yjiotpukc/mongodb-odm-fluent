<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder;

use yjiotpukc\MongoODMFluent\Type\FileMetadata;
use yjiotpukc\MongoODMFluent\Type\Id\Id;
use yjiotpukc\MongoODMFluent\Type\Index;
use yjiotpukc\MongoODMFluent\Type\ReadPreferenceMode;
use yjiotpukc\MongoODMFluent\Type\Shard;

interface File
{
    public function db(string $name): File;

    public function bucket(string $name): File;

    public function repository(string $className): File;

    public function readOnly(): File;

    public function chunkSize(int $bytes): File;

    /**
     * @param int|string|null $writeConcern
     */
    public function writeConcern($writeConcern): File;

    public function readPreference(): ReadPreferenceMode;

    /**
     * @param string|string[] $keys
     * @return Index
     */
    public function index($keys = []): Index;

    public function shard(): Shard;

    public function id(): Id;

    public function filenameFieldName(string $fieldName): File;

    public function uploadDateFieldName(string $fieldName): File;

    public function lengthFieldName(string $fieldName): File;

    public function chunkSizeFieldName(string $fieldName): File;

    public function metadata(): FileMetadata;
}
