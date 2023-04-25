<?php

declare(strict_types=1);

namespace Examples\Entity;

use DateTime;

class Image
{
    protected string $id;
    protected string $filename;
    protected DateTime $uploadDate;
    protected int $length;
    protected int $chunkSize;
    protected ImageMetadata $metadata;
}
