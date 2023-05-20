<?php

declare(strict_types=1);

namespace Examples\Entity;

use DateTime;

class Image
{
    protected string $id;
    protected string $customFilename;
    protected DateTime $customUploadDate;
    protected int $customLength;
    protected int $customChunkSize;
    protected ImageMetadata $customMetadata;
}
