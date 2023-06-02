<?php

declare(strict_types=1);

namespace Examples\Entity;

use DateTime;
use Doctrine\ODM\MongoDB\Mapping\Annotations\File;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Index;
use Doctrine\ODM\MongoDB\Mapping\Annotations\ReadPreference;
use Doctrine\ODM\MongoDB\Mapping\Annotations\ShardKey;
use Examples\Repository\ImageRepository;

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
}
