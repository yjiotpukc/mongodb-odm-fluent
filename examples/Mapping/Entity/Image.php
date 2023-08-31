<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Examples\Mapping\Entity;

use DateTime;
use Doctrine\ODM\MongoDB\Mapping\Annotations\File;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Index;
use Doctrine\ODM\MongoDB\Mapping\Annotations\ReadPreference;
use Doctrine\ODM\MongoDB\Mapping\Annotations\ShardKey;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\FileBuilder;
use yjiotpukc\MongoODMFluent\Examples\Mapping\Repository\ImageRepository;

/**
 * @File(
 *     bucketName="images",
 *     db="dbName",
 *     repositoryClass=ImageRepository::class,
 *     readOnly=true,
 *     writeConcern="majority",
 *     chunkSizeBytes=8192
 * )
 * @ReadPreference("nearest")
 * @ShardKey(keys={"filename"="asc"})
 */
class Image
{
    /** @Id */
    protected string $id;
    /**
     * @File\Filename
     * @Index
     */
    protected string $customFilename;
    /** @File\UploadDate */
    protected DateTime $customUploadDate;
    /** @File\Length */
    protected int $customLength;
    /** @File\ChunkSize */
    protected int $customChunkSize;
    /** @File\Metadata(targetDocument=ImageMetadata::class) */
    protected ImageMetadata $customMetadata;

    public static function loadMetadata(ClassMetadata $classMetadata): void
    {
        $builder = new FileBuilder();
        $builder->db('dbName');
        $builder->bucket('images');
        $builder->repository(ImageRepository::class);
        $builder->readOnly();
        $builder->readPreference()->nearest();
        $builder->chunkSize(8192);
        $builder->writeConcern('majority');
        $builder->id();
        $builder->filenameFieldName('customFilename');
        $builder->uploadDateFieldName('customUploadDate');
        $builder->lengthFieldName('customLength');
        $builder->chunkSizeFieldName('customChunkSize');
        $builder->metadata()->fieldName('customMetadata')->target(ImageMetadata::class);
        $builder->index('filename');
        $builder->shard()->asc('filename');
        $builder->build($classMetadata);
    }
}
