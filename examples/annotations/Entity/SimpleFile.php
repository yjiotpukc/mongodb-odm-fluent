<?php

declare(strict_types=1);

namespace Examples\Entity;

use DateTime;
use Doctrine\ODM\MongoDB\Mapping\Annotations\File;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;

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
}
