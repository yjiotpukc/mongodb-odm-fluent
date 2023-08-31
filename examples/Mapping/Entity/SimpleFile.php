<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Examples\Mapping\Entity;

use DateTime;
use Doctrine\ODM\MongoDB\Mapping\Annotations\File;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\FileBuilder;

/** @File(bucketName="images", db="dbName") */
class SimpleFile
{
    /** @Id */
    protected string $id;
    /** @File\Filename */
    protected string $filename;
    /** @File\UploadDate */
    protected DateTime $uploadDate;
    /** @File\Length */
    protected int $length;
    /** @File\ChunkSize */
    protected int $chunkSize;
    /** @File\Metadata(targetDocument=ImageMetadata::class) */
    protected ImageMetadata $metadata;

    public static function loadMetadata(ClassMetadata $classMetadata): void
    {
        $builder = new FileBuilder();
        $builder->db('dbName');
        $builder->bucket('images');
        $builder->id();
        $builder->metadata()->target(ImageMetadata::class);
        $builder->build($classMetadata);
    }
}
