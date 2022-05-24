<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document;

use yjiotpukc\MongoODMFluent\Builder\BaseBuilder;
use yjiotpukc\MongoODMFluent\Builder\Database\BucketBuilder;
use yjiotpukc\MongoODMFluent\Builder\Database\ChunkSizeBuilder;
use yjiotpukc\MongoODMFluent\Builder\Database\DbBuilder;
use yjiotpukc\MongoODMFluent\Builder\Database\IndexBuilder;
use yjiotpukc\MongoODMFluent\Builder\Database\ReadOnlyBuilder;
use yjiotpukc\MongoODMFluent\Builder\Database\ReadPreferenceBuilder;
use yjiotpukc\MongoODMFluent\Builder\Database\RepositoryClassBuilder;
use yjiotpukc\MongoODMFluent\Builder\Database\ShardBuilder;
use yjiotpukc\MongoODMFluent\Builder\Database\WriteConcernBuilder;
use yjiotpukc\MongoODMFluent\Builder\Field\FieldBuilder;
use yjiotpukc\MongoODMFluent\Builder\Field\FileMetadataBuilder;
use yjiotpukc\MongoODMFluent\Builder\Field\IdBuilder;
use yjiotpukc\MongoODMFluent\Mapping\FileMapping;
use yjiotpukc\MongoODMFluent\Type\FileMetadata;
use yjiotpukc\MongoODMFluent\Type\Index;
use yjiotpukc\MongoODMFluent\Type\ReadPreferenceMode;
use yjiotpukc\MongoODMFluent\Type\Shard;

class FileBuilder extends BaseBuilder implements FileMapping
{
    public function db(string $name): FileBuilder
    {
        return $this->addBuilderAndReturnSelf(new DbBuilder($name));
    }

    public function bucket(string $name): FileMapping
    {
        return $this->addBuilderAndReturnSelf(new BucketBuilder($name));
    }

    public function repository(string $className): FileBuilder
    {
        return $this->addBuilderAndReturnSelf(new RepositoryClassBuilder($className));
    }

    public function readOnly(): FileBuilder
    {
        return $this->addBuilderAndReturnSelf(new ReadOnlyBuilder());
    }

    public function chunkSize(int $bytes): FileMapping
    {
        return $this->addBuilderAndReturnSelf(new ChunkSizeBuilder($bytes));
    }

    /**
     * @param int|string|null $writeConcern
     */
    public function writeConcern($writeConcern): FileBuilder
    {
        return $this->addBuilderAndReturnSelf(new WriteConcernBuilder($writeConcern));
    }

    public function readPreference(): ReadPreferenceMode
    {
        return $this->addBuilder(new ReadPreferenceBuilder());
    }

    /**
     * @param string|string[] $keys
     */
    public function index($keys = []): Index
    {
        return $this->addBuilder(new IndexBuilder($keys));
    }

    public function shard(): Shard
    {
        return $this->addBuilder(new ShardBuilder());
    }

    public function id(): IdBuilder
    {
        return $this->addBuilder(new IdBuilder());
    }

    public function filenameFieldName(string $fieldName): FileMapping
    {
        $filename = new FieldBuilder('string', $fieldName);
        $filename->nameInDb('filename')->notSaved();

        return $this->addBuilderAndReturnSelf($filename);
    }

    public function uploadDateFieldName(string $fieldName): FileMapping
    {
        $uploadDate = new FieldBuilder('date', $fieldName);
        $uploadDate->nameInDb('uploadDate')->notSaved();

        return $this->addBuilderAndReturnSelf($uploadDate);
    }

    public function lengthFieldName(string $fieldName): FileMapping
    {
        $length = new FieldBuilder('int', $fieldName);
        $length->nameInDb('length')->notSaved();

        return $this->addBuilderAndReturnSelf($length);
    }

    public function chunkSizeFieldName(string $fieldName): FileMapping
    {
        $length = new FieldBuilder('int', $fieldName);
        $length->nameInDb('chunkSize')->notSaved();

        return $this->addBuilderAndReturnSelf($length);
    }

    public function metadata(): FileMetadata
    {
        return $this->addBuilder(new FileMetadataBuilder());
    }
}
