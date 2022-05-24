<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Mapping;

use yjiotpukc\MongoODMFluent\Type\FileMetadata;
use yjiotpukc\MongoODMFluent\Type\Id\Id;
use yjiotpukc\MongoODMFluent\Type\Index;
use yjiotpukc\MongoODMFluent\Type\ReadPreferenceMode;
use yjiotpukc\MongoODMFluent\Type\Shard;

interface FileMapping
{
    public function db(string $name): FileMapping;

    public function bucket(string $name): FileMapping;

    public function repository(string $className): FileMapping;

    public function readOnly(): FileMapping;

    public function chunkSize(int $bytes): FileMapping;

    /**
     * @param int|string|null $writeConcern
     */
    public function writeConcern($writeConcern): FileMapping;

    public function readPreference(): ReadPreferenceMode;

    /**
     * @param string|string[] $keys
     * @return Index
     */
    public function index($keys = []): Index;

    public function shard(): Shard;

    public function id(): Id;

    public function filenameFieldName(string $fieldName): FileMapping;

    public function uploadDateFieldName(string $fieldName): FileMapping;

    public function lengthFieldName(string $fieldName): FileMapping;

    public function chunkSizeFieldName(string $fieldName): FileMapping;

    public function metadata(): FileMetadata;
}
